<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Book extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('file');
        $this->lang->load('message', 'english');
        $this->load->library('auth');
        $this->auth->is_logged_in_parent();
    }

    public function index() {
        $this->session->set_userdata('top_menu', 'Library');
        $this->session->set_userdata('sub_menu', 'book/index');
        $sessionData = $this->session->userdata('student');
       
        $data['title'] = 'Add Book';
        $data['title_list'] = 'Book Details';
        $listbook = $this->book_model->listbook_by_school($sessionData['school']);
        $data['listbook'] = $listbook;
        $this->load->view('layout/parent/header');
        $this->load->view('parent/book/createbook', $data);
        $this->load->view('layout/parent/footer');
    }

    function create() {
        $data['title'] = 'Add Book';
        $data['title_list'] = 'Book Details';
        $this->form_validation->set_rules('book_title', 'Book Title', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $listbook = $this->book_model->listbook();
            $data['listbook'] = $listbook;
            $this->load->view('layout/header');
            $this->load->view('parent/book/createbook', $data);
            $this->load->view('layout/footer');
        } else {
            $data = array(
                'book_title' => $this->input->post('book_title'),
                'subject' => $this->input->post('subject'),
                'rack_no' => $this->input->post('rack_no'),
                'publish' => $this->input->post('publish'),
                'author' => $this->input->post('author'),
                'qty' => $this->input->post('qty'),
                'perunitcost' => $this->input->post('perunitcost'),
                'postdate' => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('postdate'))),
                'description' => $this->input->post('description')
            );
            $this->book_model->addbooks($data);
            redirect('parent/book/index');
        }
    }

    function edit($id) {
        $data['title'] = 'Edit Book';
        $data['title_list'] = 'Book Details';
        $data['id'] = $id;
        $editbook = $this->book_model->get($id);
        $data['editbook'] = $editbook;
        $this->form_validation->set_rules('book_title', 'Book Title', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $listbook = $this->book_model->listbook();
            $data['listbook'] = $listbook;
            $this->load->view('layout/parent/header');
            $this->load->view('parent/book/editbook', $data);
            $this->load->view('layout/parent/footer');
        } else {
            $data = array(
                'id' => $this->input->post('id'),
                'book_title' => $this->input->post('book_title'),
                'subject' => $this->input->post('subject'),
                'rack_no' => $this->input->post('rack_no'),
                'publish' => $this->input->post('publish'),
                'author' => $this->input->post('author'),
                'qty' => $this->input->post('qty'),
                'perunitcost' => $this->input->post('perunitcost'),
                'postdate' => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('postdate'))),
                'description' => $this->input->post('description')
            );
            $this->book_model->addbooks($data);
            $this->session->set_flashdata('msg', '<div feemaster="alert alert-success text-center">book details added to Database!!!</div>');
            redirect('parent/book/index');
        }
    }

    function delete($id) {
        $data['title'] = 'Fees Master List';
        $this->book_model->remove($id);
        redirect('parent/book/index');
    }
    
    
     public function issue() {
         
        $id = $this->customlib->getStudentSessionUserID();

        $this->session->set_userdata('top_menu', 'Library');
        $this->session->set_userdata('sub_menu', 'member/index');
        $data['title'] = 'Member';
        $data['title_list'] = 'Members';
        $memberList = $this->librarymember_model->getByMemberID($id);
        $data['memberList'] = $memberList;
        $issued_books = $this->bookissue_model->getMemberBooks($id);
        $data['issued_books'] = $issued_books;
        $bookList = $this->book_model->get();
        $data['bookList'] = $bookList;
        $this->form_validation->set_rules('book_id', 'Book', 'trim|required|xss_clean');
        $this->form_validation->set_rules('return_date', 'Return Date', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            
        } else {
            $member_id = $this->input->post('member_id');
            $data = array(
                'book_id' => $this->input->post('book_id'),
                'return_date' => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('return_date'))),
                'issue_date' => date('Y-m-d'),
                'member_id' => $this->input->post('member_id'),
            );
            $this->bookissue_model->add($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Book issued successfully.</div>');
            redirect('parent/member/issue/' . $member_id);
        }

        $this->load->view('layout/parent/header');
        $this->load->view('parent/book/issue', $data);
        $this->load->view('layout/parent/footer');
    }


  public function returned() {
        
        $stu_id = $this->customlib->getStudentSessionUserID();
        $d=$this->db->get_where("libarary_members",array("member_id"=>$stu_id))->row();
        $id=$d->id;
        $this->session->set_userdata('top_menu', 'Library');
        $this->session->set_userdata('sub_menu', 'member/index');
        $data['title'] = 'Member';
        $data['title_list'] = 'Members';
        
        $memberList = $this->librarymember_model->getByMemberID($id);
        $data['memberList'] = $memberList;
        $issued_books = $this->bookissue_model->getReturnedBooks($id);
        $data['issued_books'] = $issued_books;
        $bookList = $this->book_model->get();
        $data['bookList'] = $bookList;
        $this->form_validation->set_rules('book_id', 'Book', 'trim|required|xss_clean');
        $this->form_validation->set_rules('return_date', 'Return Date', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            
        } else {
            $member_id = $this->input->post('member_id');
            $data = array(
                'book_id' => $this->input->post('book_id'),
                'return_date' => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('return_date'))),
                'issue_date' => date('Y-m-d'),
                'member_id' => $this->input->post('member_id'),
            );
            $this->bookissue_model->add($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Book issued successfully.</div>');
            redirect('parent/member/issue/' . $member_id);
        }

        $this->load->view('layout/parent/header');
        $this->load->view('parent/book/returned', $data);
        $this->load->view('layout/parent/footer');
    }



}

?>