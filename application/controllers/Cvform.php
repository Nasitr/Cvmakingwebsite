<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cvform extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('myfpdf');

        // Check if user is logged in
        if (!$this->session->userdata('user_name')) {
            // If not logged in, redirect to Signin page
            redirect('Signin');
        }
    }

    public function index() {
        $this->load->view('cvform');
    }

   public function submit() {
//    echo "<pre>"; print_r($_POST); print_r($_FILES); exit;
    $profile_image = '';
    
    if (!empty($_FILES['profile_image']['name'])) {
        $config['upload_path']   = './assets/images/profile/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size']      = 2048; // 2MB
        $config['file_name']     = time() . '_' . $_FILES['profile_image']['name'];
        $this->load->library('upload', $config);
        
        if ($this->upload->do_upload('profile_image')) {
            $uploadData = $this->upload->data();
            // print_r($uploadData); exit;
            // Save relative path (for use in <img src=...>)
            $profile_image = 'assets/images/profile/' . $uploadData['file_name'];
        } else {
            // Log error if upload fails
            $error = $this->upload->display_errors();
            log_message('error', 'Image Upload Error: ' . $error);
        }
            // print_r($profile_image); 
            // print_r($error); 
            // exit;

    }else{
        $profile_image="error";
    }
    //    echo "<pre>"; print_r($profile_image);  exit;


    $form_data = [
        'full_name'             => $this->input->post('full_name'),
        'designation'           => $this->input->post('designation'),
        'email'                 => $this->input->post('email'),
        'phone'                 => $this->input->post('phone'),
        'address'               => $this->input->post('address'),
        'career_objective'      => $this->input->post('objective'),
        'skills'                => $this->input->post('skills'),
        'education_json'        => json_encode($this->input->post('education')),
        'work_experience_json'  => json_encode($this->input->post('work_experience')),
        'languages_json'        => json_encode($this->input->post('languages')),
        'hobbies_json'          => json_encode($this->input->post('hobbies')),
        'certifications_json'   => json_encode($this->input->post('certifications')),
        'profile_image'         => $profile_image,
        'created_at'            => date('Y-m-d H:i:s')
    ];
//    echo "<pre>"; print_r($form_data);  exit;

    $this->db->insert('cvs', $form_data);
    $insert_id = $this->db->insert_id();

    redirect('Cvform/show_pdfs/' . $insert_id);
}

    public function show_pdfs($id) {
    if (empty($id)) {
        show_error("Invalid CV ID.");
        return;
    }

    // Generate PDFs and collect filenames
    $style1 = $this->generate_pdf_style1($id);
    $style2 = $this->generate_pdf_style2($id);
    $style3 = $this->generate_pdf_style3($id);
    $style4 = $this->generate_pdf_style4($id);

    if (!$style1 || !$style2 || !$style3) {
        show_error("One or more PDFs failed to generate.");
        return;
    }

    $this->load->view('cv_pdf_links', [
        'pdfs' => [
            'CV Style 1' => base_url('downloads/' . $style1),
            'CV Style 2' => base_url('downloads/' . $style2),
            'CV Style 3' => base_url('downloads/' . $style3),
            'CV Style 4' => base_url('downloads/' . $style4)
        ]
    ]);
}


   private function generate_pdf_style1($id)
{
    $cv = $this->db->get_where('cvs', ['id' => $id])->row_array();
    if (!$cv) {
        show_error('CV not found');
        return false;
    }

    // Decode JSON fields
    $cv['education']     = json_decode($cv['education_json'], true);
    $cv['experience']    = json_decode($cv['work_experience_json'], true);
    $cv['languages']     = json_decode($cv['languages_json'], true);
    $cv['hobbies']       = json_decode($cv['hobbies_json'], true);
    $cv['certifications']= json_decode($cv['certifications_json'], true);

    $pdf = new Myfpdf();
    $pdf->AddPage();

    $pdf->SetFont('Arial', 'B', 25);
    $pdf->Cell(0, 10, $cv['full_name'], 0, 1, 'C');

     // Contact Section
        $pdf->Ln(5);
        $pdf->SetFont('Arial', 'B', 16); // Section title
        $pdf->Cell(0, 10, 'Contact', 0, 1);

        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(30, 8, 'Email:', 0, 0);
        $pdf->SetFont('Arial', '', 14);
        $pdf->Cell(0, 8, $cv['email'], 0, 1);

        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(30, 8, 'Phone:', 0, 0);
        $pdf->SetFont('Arial', '', 14);
        $pdf->Cell(0, 8, $cv['phone'], 0, 1);

        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(30, 8, 'Address:', 0, 0);
        $pdf->SetFont('Arial', '', 14);
        $pdf->MultiCell(0, 8, $cv['address']);

        // Career Objective
        $pdf->Ln(5);
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 10, 'Career Objective', 0, 1);
        $pdf->SetFont('Arial', '', 14);
        $pdf->MultiCell(0, 8, $cv['career_objective']);

        // Education
        $pdf->Ln(5);
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 10, 'Education', 0, 1);
        $pdf->SetFont('Arial', '', 14);
        foreach ($cv['education'] as $edu) {
            $pdf->Cell(0, 8, "{$edu['course']} - {$edu['institute']} ({$edu['year']})", 0, 1);
        }

        // Work Experience
        $pdf->Ln(5);
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 10, 'Work Experience', 0, 1);
        $pdf->SetFont('Arial', '', 14);
        foreach ($cv['experience'] as $exp) {
            $end = isset($exp['present']) && $exp['present'] ? 'Present' : $exp['end_date'];
            $pdf->MultiCell(0, 8, "{$exp['job_title']} at {$exp['company']} ({$exp['start_date']} - $end)");
        }

        // Skills
        $pdf->Ln(5);
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 10, 'Skills', 0, 1);
        $pdf->SetFont('Arial', '', 14);
        $pdf->MultiCell(0, 8, $cv['skills']);

        // Certifications
        $pdf->Ln(5);
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 10, 'Certifications', 0, 1);
        $pdf->SetFont('Arial', '', 14);
        foreach ($cv['certifications'] as $cert) {
            if (!empty($cert)) {
                $pdf->Cell(0, 8, '- ' . $cert, 0, 1);
            }
        }

        // Languages Known
        $pdf->Ln(5);
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 10, 'Languages Known', 0, 1);
        $pdf->SetFont('Arial', '', 14);
        foreach ($cv['languages'] as $lang) {
            if (!empty($lang)) {
                $pdf->Cell(0, 8, '- ' . $lang, 0, 1);
            }
        }

        // Hobbies
        $pdf->Ln(5);
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 10, 'Hobbies', 0, 1);
        $pdf->SetFont('Arial', '', 14);
        foreach ($cv['hobbies'] as $hobby) {
            if (!empty($hobby)) {
                $pdf->Cell(0, 8, '- ' . $hobby, 0, 1);
            }
        }

    // Save to downloads folder
    $filename = 'cv_style1_' . $id . '_' . time() . '.pdf';
    $save_path = FCPATH . 'downloads/' . $filename;
    $pdf->Output('F', $save_path);
    return $filename;
}


    private function generate_pdf_style2($id)
{
    $cv = $this->db->get_where('cvs', ['id' => $id])->row_array();
    if (!$cv) {
        show_error('CV not found');
        return;
    }

    // Decode JSON fields
    $cv['education']      = json_decode($cv['education_json'], true);
    $cv['experience']     = json_decode($cv['work_experience_json'], true);
    $cv['languages']      = json_decode($cv['languages_json'], true);
    $cv['hobbies']        = json_decode($cv['hobbies_json'], true);
    $cv['certifications'] = json_decode($cv['certifications_json'], true);

    $pdf = new Myfpdf();
    $pdf->AddPage();
    $pdf->SetAutoPageBreak(true, 10);

    // Define Colors
    $sidebarColor = [40, 50, 70];
    $textWhite    = [255, 255, 255];
    $mainText     = [40, 40, 40];
    $highlight    = [70, 130, 180];

    $sidebarWidth = 60;

    // Sidebar Background
    $pdf->SetFillColor(...$sidebarColor);
    $pdf->Rect(0, 0, $sidebarWidth, 297, 'F');

    // Header - Name
    $pdf->SetXY($sidebarWidth + 5, 10);
    $pdf->SetFont('Arial', 'B', 24);
    $pdf->SetTextColor(...$mainText);
    $pdf->Cell(0, 10, $cv['full_name'], 0, 1);

    // Start Sidebar Content
    $y = 30;
    $pdf->SetXY(10, $y);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->SetTextColor(...$textWhite);
    $pdf->Cell(50, 8, 'Contact', 0, 1);

    $pdf->SetFont('Arial', '', 10);
    $pdf->SetTextColor(...$textWhite);
    $pdf->SetX(10); $pdf->Cell(50, 6, $cv['email'], 0, 1);
    $pdf->SetX(10); $pdf->Cell(50, 6, $cv['phone'], 0, 1);
    $pdf->SetX(10); $pdf->MultiCell(50, 6, $cv['address'], 0, 1);

    // Skills
    $pdf->Ln(2);
    $pdf->SetX(10);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(50, 8, 'Skills', 0, 1);
    $pdf->SetFont('Arial', '', 10);
    foreach (explode(',', $cv['skills']) as $skill) {
        $pdf->SetX(10);
        $pdf->Cell(50, 6, trim($skill), 0, 1);
    }

    // Languages
    $pdf->Ln(2);
    $pdf->SetX(10);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(50, 8, 'Languages', 0, 1);
    $pdf->SetFont('Arial', '', 10);
    foreach ($cv['languages'] as $lang) {
        $pdf->SetX(10);
        $pdf->Cell(50, 6, $lang, 0, 1);
    }

    // Hobbies
    $pdf->Ln(2);
    $pdf->SetX(10);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(50, 8, 'Hobbies', 0, 1);
    $pdf->SetFont('Arial', '', 10);
    foreach ($cv['hobbies'] as $hobby) {
        $pdf->SetX(10);
        $pdf->Cell(50, 6, $hobby, 0, 1);
    }

    // Main Content Starts
    $mainX = $sidebarWidth + 10;
    $currentY = 30;
    $pdf->SetXY($mainX, $currentY);
    $pdf->SetTextColor(...$highlight);
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->Cell(0, 10, 'Career Objective', 0, 1);

    $pdf->SetTextColor(...$mainText);
    $pdf->SetFont('Arial', '', 12);
    $pdf->SetX($mainX);
    $pdf->MultiCell(130, 7, $cv['career_objective']);
    $pdf->Ln(3);

    // Education
    $pdf->SetX($mainX);
    $pdf->SetTextColor(...$highlight);
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->Cell(0, 10, 'Education', 0, 1);
    $pdf->SetTextColor(...$mainText);
    $pdf->SetFont('Arial', '', 12);
    foreach ($cv['education'] as $edu) {
        $pdf->SetX($mainX);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 8, $edu['course'], 0, 1);
        $pdf->SetX($mainX);
        $pdf->SetFont('Arial', '', 11);
        $pdf->Cell(0, 6, "{$edu['institute']} ({$edu['year']})", 0, 1);
        $pdf->Ln(1);
    }

    // Work Experience
    $pdf->Ln(2);
    $pdf->SetX($mainX);
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->SetTextColor(...$highlight);
    $pdf->Cell(0, 10, 'Work Experience', 0, 1);
    $pdf->SetFont('Arial', '', 12);
    $pdf->SetTextColor(...$mainText);
    foreach ($cv['experience'] as $exp) {
        $end = isset($exp['present']) && $exp['present'] ? 'Present' : $exp['end_date'];
        $pdf->SetX($mainX);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 8, "{$exp['job_title']} at {$exp['company']}", 0, 1);
        $pdf->SetX($mainX);
        $pdf->SetFont('Arial', '', 11);
        $pdf->Cell(0, 6, "{$exp['start_date']} - $end", 0, 1);
        $pdf->Ln(1);
    }

    // Certifications
    $pdf->Ln(2);
    $pdf->SetX($mainX);
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->SetTextColor(...$highlight);
    $pdf->Cell(0, 10, 'Certifications', 0, 1);
    $pdf->SetFont('Arial', '', 12);
    $pdf->SetTextColor(...$mainText);
    foreach ($cv['certifications'] as $cert) {
        if (!empty($cert)) {
            $pdf->SetX($mainX);
            $pdf->Cell(0, 8, '- ' . $cert, 0, 1);
        }
    }

    // Output PDF
    $filename = 'cv_style2_' . $id . '_' . time() . '.pdf';
    $save_path = FCPATH . 'downloads/' . $filename;
    $pdf->Output('F', $save_path);
    return $filename;
}

 private function generate_pdf_style3($id)
{
    $cv = $this->db->get_where('cvs', ['id' => $id])->row_array();
    if (!$cv) {
        show_error('CV not found');
        return;
    }

    // Decode JSON fields
    $cv['education']      = json_decode($cv['education_json'], true);
    $cv['experience']     = json_decode($cv['work_experience_json'], true);
    $cv['languages']      = json_decode($cv['languages_json'], true);
    $cv['hobbies']        = json_decode($cv['hobbies_json'], true);
    $cv['certifications'] = json_decode($cv['certifications_json'], true);

    $pdf = new Myfpdf();
    $pdf->AddPage();
    $pdf->SetAutoPageBreak(true, 10);

    // Define Colors
    $sidebarColor = [40, 50, 70];
    $textWhite    = [255, 255, 255];
    $mainText     = [40, 40, 40];
    $highlight    = [70, 130, 180];

    $sidebarWidth = 60;

    // Sidebar Background
    $pdf->SetFillColor(...$sidebarColor);
    $pdf->Rect(0, 0, $sidebarWidth, 297, 'F');

    // Profile Image (optional)
    if (!empty($cv['profile_image'])) {
        $image_path = FCPATH . $cv['profile_image']; // full path
        if (file_exists($image_path)) {
            // Resize and place the image in the sidebar
            $pdf->Image($image_path, 10, 10, 40, 40); // (x, y, width, height)
        }
    }

    // Header - Name
    $pdf->SetXY($sidebarWidth + 5, 10);
    $pdf->SetFont('Arial', 'B', 24);
    $pdf->SetTextColor(...$mainText);
    $pdf->Cell(0, 10, $cv['full_name'], 0, 1);

    // Start Sidebar Content
    $y = 60;
    $pdf->SetXY(10, $y);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->SetTextColor(...$textWhite);
    $pdf->Cell(50, 8, 'Contact', 0, 1);

    $pdf->SetFont('Arial', '', 10);
    $pdf->SetTextColor(...$textWhite);
    $pdf->SetX(10); $pdf->Cell(50, 6, $cv['email'], 0, 1);
    $pdf->SetX(10); $pdf->Cell(50, 6, $cv['phone'], 0, 1);
    $pdf->SetX(10); $pdf->MultiCell(50, 6, $cv['address'], 0, 1);

    // Skills
    $pdf->Ln(2);
    $pdf->SetX(10);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(50, 8, 'Skills', 0, 1);
    $pdf->SetFont('Arial', '', 10);
    foreach (explode(',', $cv['skills']) as $skill) {
        $pdf->SetX(10);
        $pdf->Cell(50, 6, trim($skill), 0, 1);
    }

    // Languages
    $pdf->Ln(2);
    $pdf->SetX(10);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(50, 8, 'Languages', 0, 1);
    $pdf->SetFont('Arial', '', 10);
    foreach ($cv['languages'] as $lang) {
        $pdf->SetX(10);
        $pdf->Cell(50, 6, $lang, 0, 1);
    }

    // Hobbies
    $pdf->Ln(2);
    $pdf->SetX(10);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(50, 8, 'Hobbies', 0, 1);
    $pdf->SetFont('Arial', '', 10);
    foreach ($cv['hobbies'] as $hobby) {
        $pdf->SetX(10);
        $pdf->Cell(50, 6, $hobby, 0, 1);
    }

    // Main Content Starts
    $mainX = $sidebarWidth + 10;
    $currentY = 30;
    $pdf->SetXY($mainX, $currentY);
    $pdf->SetTextColor(...$highlight);
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->Cell(0, 10, 'Career Objective', 0, 1);

    $pdf->SetTextColor(...$mainText);
    $pdf->SetFont('Arial', '', 12);
    $pdf->SetX($mainX);
    $pdf->MultiCell(130, 7, $cv['career_objective']);
    $pdf->Ln(3);

    // Education
    $pdf->SetX($mainX);
    $pdf->SetTextColor(...$highlight);
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->Cell(0, 10, 'Education', 0, 1);
    $pdf->SetTextColor(...$mainText);
    $pdf->SetFont('Arial', '', 12);
    foreach ($cv['education'] as $edu) {
        $pdf->SetX($mainX);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 8, $edu['course'], 0, 1);
        $pdf->SetX($mainX);
        $pdf->SetFont('Arial', '', 11);
        $pdf->Cell(0, 6, "{$edu['institute']} ({$edu['year']})", 0, 1);
        $pdf->Ln(1);
    }

    // Work Experience
    $pdf->Ln(2);
    $pdf->SetX($mainX);
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->SetTextColor(...$highlight);
    $pdf->Cell(0, 10, 'Work Experience', 0, 1);
    $pdf->SetFont('Arial', '', 12);
    $pdf->SetTextColor(...$mainText);
    foreach ($cv['experience'] as $exp) {
        $end = isset($exp['present']) && $exp['present'] ? 'Present' : $exp['end_date'];
        $pdf->SetX($mainX);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 8, "{$exp['job_title']} at {$exp['company']}", 0, 1);
        $pdf->SetX($mainX);
        $pdf->SetFont('Arial', '', 11);
        $pdf->Cell(0, 6, "{$exp['start_date']} - $end", 0, 1);
        $pdf->Ln(1);
    }

    // Certifications
    $pdf->Ln(2);
    $pdf->SetX($mainX);
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->SetTextColor(...$highlight);
    $pdf->Cell(0, 10, 'Certifications', 0, 1);
    $pdf->SetFont('Arial', '', 12);
    $pdf->SetTextColor(...$mainText);
    foreach ($cv['certifications'] as $cert) {
        if (!empty($cert)) {
            $pdf->SetX($mainX);
            $pdf->Cell(0, 8, '- ' . $cert, 0, 1);
        }
    }

    // Save PDF to downloads folder
    $filename = 'cv_style3_' . $id . '_' . time() . '.pdf';
    $save_path = FCPATH . 'downloads/' . $filename;
    $pdf->Output('F', $save_path);
    return $filename;
}
 
private function generate_pdf_style4($id)
{
    $cv = $this->db->get_where('cvs', ['id' => $id])->row_array();
    if (!$cv) {
        show_error('CV not found');
        return;
    }

    // Decode JSON
    $cv['education'] = json_decode($cv['education_json'], true);
    $cv['experience'] = json_decode($cv['work_experience_json'], true);
    $cv['languages'] = json_decode($cv['languages_json'], true);
    $cv['hobbies'] = json_decode($cv['hobbies_json'], true);
    $cv['certifications'] = json_decode($cv['certifications_json'], true);

    $pdf = new Myfpdf();
    $pdf->AddPage();
    $pdf->SetAutoPageBreak(true, 15);

    $highlight = [0, 102, 204];
    $divider = [200, 200, 200];
    $black = [30, 30, 30];
    $gray = [90, 90, 90];

    // Profile Image
    if (!empty($cv['profile_image'])) {
        $imgPath = FCPATH . $cv['profile_image'];
        if (file_exists($imgPath)) {
            $pdf->Image($imgPath, 10, 10, 35, 35);
        }
    }

    // Name and Title
    $pdf->SetXY(50, 12);
    $pdf->SetFont('Arial', 'B', 22);
    $pdf->SetTextColor(...$black);
    $pdf->Cell(0, 10, $cv['full_name'], 0, 1);

    // Contact Info
    $pdf->SetXY(50, 25);
    $pdf->SetFont('Arial', '', 11);
    $pdf->SetTextColor(...$gray);
    $pdf->Cell(0, 6, $cv['email'] . ' | ' . $cv['phone'], 0, 1);
    $pdf->SetX(50);
    $pdf->Cell(0, 6, $cv['address'], 0, 1);

    $pdf->Ln(10);

    // Career Objective
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->SetTextColor(...$highlight);
    $pdf->Cell(0, 8, 'Career Objective', 0, 1);
    $pdf->SetDrawColor(...$divider);
    $pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());
    $pdf->Ln(2);
    $pdf->SetFont('Arial', '', 11);
    $pdf->SetTextColor(...$black);
    $pdf->MultiCell(0, 6, $cv['career_objective']);
    $pdf->Ln(5);

    // Education Section
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->SetTextColor(...$highlight);
    $pdf->Cell(0, 8, 'Education', 0, 1);
    $pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());
    $pdf->Ln(2);
    $pdf->SetFont('Arial', '', 11);
    $pdf->SetTextColor(...$black);
    foreach ($cv['education'] as $edu) {
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 6, $edu['course'], 0, 1);
        $pdf->SetFont('Arial', '', 11);
        $pdf->Cell(0, 6, $edu['institute'] . ' | ' . $edu['year'], 0, 1);
        $pdf->Ln(2);
    }

    // Work Experience
    $pdf->Ln(3);
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->SetTextColor(...$highlight);
    $pdf->Cell(0, 8, 'Work Experience', 0, 1);
    $pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());
    $pdf->Ln(2);
    $pdf->SetFont('Arial', '', 11);
    $pdf->SetTextColor(...$black);
    foreach ($cv['experience'] as $exp) {
        $end = isset($exp['present']) && $exp['present'] ? 'Present' : $exp['end_date'];
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 6, $exp['job_title'] . ' at ' . $exp['company'], 0, 1);
        $pdf->SetFont('Arial', '', 11);
        $pdf->Cell(0, 6, $exp['start_date'] . ' - ' . $end, 0, 1);
        $pdf->Ln(2);
    }

    // Skills
    $pdf->Ln(2);
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->SetTextColor(...$highlight);
    $pdf->Cell(0, 8, 'Skills', 0, 1);
    $pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());
    $pdf->Ln(2);
    $pdf->SetFont('Arial', '', 11);
    $pdf->SetTextColor(...$black);
    foreach (explode(',', $cv['skills']) as $skill) {
        $pdf->Cell(0, 6, '- ' . trim($skill), 0, 1);
    }

    // Languages
    $pdf->Ln(2);
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->SetTextColor(...$highlight);
    $pdf->Cell(0, 8, 'Languages', 0, 1);
    $pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());
    $pdf->Ln(2);
    $pdf->SetFont('Arial', '', 11);
    $pdf->SetTextColor(...$black);
    foreach ($cv['languages'] as $lang) {
        $pdf->Cell(0, 6, '- ' . $lang, 0, 1);
    }

    // Certifications
    if (!empty($cv['certifications'])) {
        $pdf->Ln(2);
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->SetTextColor(...$highlight);
        $pdf->Cell(0, 8, 'Certifications', 0, 1);
        $pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());
        $pdf->Ln(2);
        $pdf->SetFont('Arial', '', 11);
        $pdf->SetTextColor(...$black);
        foreach ($cv['certifications'] as $cert) {
            if (!empty($cert)) {
                $pdf->Cell(0, 6, '- ' . $cert, 0, 1);
            }
        }
    }

    // Hobbies
    if (!empty($cv['hobbies'])) {
        $pdf->Ln(2);
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->SetTextColor(...$highlight);
        $pdf->Cell(0, 8, 'Hobbies', 0, 1);
        $pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());
        $pdf->Ln(2);
        $pdf->SetFont('Arial', '', 11);
        $pdf->SetTextColor(...$black);
        foreach ($cv['hobbies'] as $hobby) {
            $pdf->Cell(0, 6, '- ' . $hobby, 0, 1);
        }
    }

    // Save PDF
    $filename = 'cv_style4_' . $id . '_' . time() . '.pdf';
    $save_path = FCPATH . 'downloads/' . $filename;
    $pdf->Output('F', $save_path);
    return $filename;
}




   
}
