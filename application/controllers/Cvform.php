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
        $form_data = [
            'full_name'             => $this->input->post('full_name'),
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
            'created_at'            => date('Y-m-d H:i:s')
        ];

        // Save to DB
        $this->db->insert('cvs', $form_data);
        $insert_id = $this->db->insert_id();

        // Redirect to show both PDFs
        redirect('Cvform/show_pdfs/' . $insert_id);
    }

    public function show_pdfs($id) {
        if (empty($id)) {
            show_error("Invalid CV ID.");
            return;
        }

        // Generate PDFs
        $style1 = $this->generate_pdf_style1($id);
        $style2 = $this->generate_pdf_style2($id);

        // Show download links
        $this->load->view('cv_pdf_links', [
            'pdfs' => [
                'CV Style 1' => base_url('downloads/' . $style1),
                'CV Style 2' => base_url('downloads/' . $style2)
            ]
        ]);
    }

    private function generate_pdf_style1($id)
    {
        $cv = $this->db->get_where('cvs', ['id' => $id])->row_array();

        if (!$cv) {
            show_error('CV not found');
            return;
        }

        // Decode JSON fields
        $cv['education']     = json_decode($cv['education_json'], true);
        $cv['experience']    = json_decode($cv['work_experience_json'], true);
        $cv['languages']     = json_decode($cv['languages_json'], true);
        $cv['hobbies']       = json_decode($cv['hobbies_json'], true);
        $cv['certifications']= json_decode($cv['certifications_json'], true);

        $pdf = new Myfpdf();
        $pdf->AddPage();

        // Name
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

        // Output PDF in browser
        $filename = 'cv_style1_' . $id . '_' . time() . '.pdf';
        $pdf->Output('F', $filename); // Show in browser
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
    $filename = 'cv_fancy_' . $id . '_' . time() . '.pdf';
    $pdf->Output('I', $filename);
}



    // private function generate_pdf_style2($id) {
    //     $cv = $this->db->get_where('cvs', ['id' => $id])->row_array();

    //     if (!$cv) {
    //         show_error('CV not found');
    //         return;
    //     }

    //     $pdf = new Myfpdf();
    //     $pdf->AddPage();
    //     $pdf->SetFont('Arial', 'B', 14);
    //     $pdf->Cell(0, 10, 'Simple CV - Style 2', 0, 1, 'C');

    //     $pdf->SetFont('Arial', '', 11);
    //     $pdf->Cell(0, 10, 'Name: ' . $cv['full_name'], 0, 1);
    //     $pdf->Cell(0, 10, 'Email: ' . $cv['email'], 0, 1);
    //     $pdf->Cell(0, 10, 'Phone: ' . $cv['phone'], 0, 1);
    //     $pdf->Ln(2);
    //     $pdf->MultiCell(0, 8, "Career Objective:\n" . $cv['career_objective']);
    //     $pdf->Ln(3);
    //     $pdf->MultiCell(0, 8, "Skills:\n" . $cv['skills']);

    //     $filename = 'cv_style2_' . $id . '_' . time() . '.pdf';
    //     $pdf->Output('F', FCPATH . 'downloads/' . $filename);
    //     return $filename;
    // }
}
