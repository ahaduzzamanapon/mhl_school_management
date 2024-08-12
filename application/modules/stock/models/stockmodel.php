<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Stockmodel extends CI_Model {
    /**
     * This model is using into the Notice controller
     * Load : $this->load->model('noticemodel');
     */
    function __construct() {
        parent::__construct();
        $this->load->dbforge();
    }

    //This function will return few vendors information
    public function vendors() {
        $data = array();
        $query = $this->db->query("SELECT id,company_name,cp_name FROM vendors");
        foreach ($query->result_array() as $row) {
            $data[] = $row;
        }
        return $data;
    }

    //This function will return single vendors information
    public function vendordetails($v_id) {
        $data = array();
        $query = $this->db->query("SELECT * FROM vendors WHERE id ='$v_id'");
        foreach ($query->result_array() as $row) {
            $data[] = $row;
        }
        return $data;
    }

    //This function will return vendor order list
    public function ven_pol($vid) {
        $data = array();
        $query = $this->db->query("SELECT * FROM inve_item WHERE vendor_id=$vid");
        foreach ($query->result_array() as $row) {
            $data[] = $row;
        }
        return $data;
    }

    //This function will return single vendors information
    public function singel_vendors($v_id) {
        $data = array();
        $query = $this->db->query("SELECT * FROM vendors WHERE id ='$v_id'");
        foreach ($query->result_array() as $row) {
            $data[] = $row;
        }
        return $data;
    }

    //This function will return all inventory category information
    public function inv_category() {
        $data = array();
        $query = $this->db->query("SELECT * FROM inven_category");
        foreach ($query->result_array() as $row) {
            $data[] = $row;
        }
        return $data;
    }

    public function get_inv_items(){
        $this->db->select('i.*, c.category_name');
        $this->db->from('inventory_item i');
        $this->db->join('inven_category c', 'c.id=i.item_category_id', 'LEFT');
        $query = $this->db->get()->result();

        return $query;
    }

    public function get_item_info($id){
        $this->db->select('i.*, c.category_name');
        $this->db->from('inventory_item i');
        $this->db->join('inven_category c', 'c.id=i.item_category_id', 'LEFT');
        $this->db->where('i.id', $id);
        $query = $this->db->get()->row();

        return $query;
    }

    public function get_purchase_items(){
        $this->db->select('p.*, v.company_name, i.item_name');
        $this->db->from('inventory_purchase p');
        $this->db->join('vendors v', 'v.id=p.purc_vendor_id', 'LEFT');
        $this->db->join('inventory_item i', 'i.id=p.purc_item_id', 'LEFT');
        $query = $this->db->get()->result();

        return $query;
    }

    public function get_vendor_payments(){
        $this->db->select('p.*, v.company_name');
        $this->db->from('vendor_payments p');
        $this->db->join('vendors v', 'v.id=p.pay_vendor_id', 'LEFT');
        $query = $this->db->get()->result();

        return $query;
    }

    public function get_item_tracking($id){
        $query = array();

        $this->db->select('item_name');
        $this->db->from('inventory_item');
        $this->db->where('id', $id);
        $query['info'] = $this->db->get()->row()->item_name;

        $this->db->select('t.*, v.company_name, i.item_name, u.first_name, u.last_name');
        $this->db->from('inventory_track t');
        $this->db->join('vendors v', 'v.id=t.track_supplier_id', 'LEFT');
        $this->db->join('inventory_item i', 'i.id=t.track_item_id', 'LEFT');
        $this->db->join('users u', 'u.id=t.track_user_id', 'LEFT');
        $this->db->where('t.track_item_id', $id);
        $query['item_transection'] = $this->db->get()->result();



        return $query;
    }

    public function get_inv_category(){
      $data[''] = '-- Select Category --';
      $this->db->select('id, category_name');
      $this->db->from('inven_category');
      // $this->db->where('is_current',1);
      $this->db->order_by('id', 'ASC');
      $query = $this->db->get();

      foreach ($query->result_array() AS $rows) {
         $data[$rows['id']] = $rows['category_name'];
      }        
      return $data;
   }

   public function get_vendors(){
      $data[''] = '-- Select Vendor --';
      $this->db->select('id, company_name');
      $this->db->from('vendors');
      // $this->db->where('is_current',1);
      $this->db->order_by('id', 'ASC');
      $query = $this->db->get();

      foreach ($query->result_array() AS $rows) {
         $data[$rows['id']] = $rows['company_name'];
      }        
      return $data;
   }

   public function get_items(){
      $data[''] = '-- Select Item --';
      $this->db->select('id, item_name');
      $this->db->from('inventory_item');
      // $this->db->where('is_current',1);
      $this->db->order_by('id', 'ASC');
      $query = $this->db->get();

      foreach ($query->result_array() AS $rows) {
         $data[$rows['id']] = $rows['item_name'];
      }        
      return $data;
   }


    //This function will return all inventory item information
    public function inv_item() {
        $data = array();
        $query = $this->db->query("SELECT * FROM inve_item");
        foreach ($query->result_array() as $row) {
            $data[] = $row;
        }
        return $data;
    }

    //This function will showe vendor title by id
    public function vendoe_title($id) {
        $data = array();
        $query = $this->db->query("SELECT company_name FROM vendors WHERE id=$id");
        foreach ($query->result_array() as $row) {
            $data = $row['company_name'];
        }
        return $data;
    }



    //This function will showe inventory item category by id
    public function category_title($id) {
        $data = array();
        $query = $this->db->query("SELECT category_name FROM inven_category WHERE id=$id");
        foreach ($query->result_array() as $row) {
            $data = $row['category_name'];
        }
        return $data;
    }

    //This function will show full details 
    public function item_details($id) {
        $data = array();
        $query = $this->db->query("SELECT * FROM inve_item WHERE id=$id");
        foreach ($query->result_array() as $row) {
            $data[] = $row;
        }
        return $data;
    }

    //This function will show all Employee list
    public function employe() {
        $data = array();
        $query = $this->db->query("SELECT id,username FROM users WHERE user_status='Employee'");
        foreach ($query->result_array() as $row) {
            $data[] = $row;
        }
        return $data;
    }

    //This function will return all issued item 
    public function issu_item() {
        $data = array();
        $query = $this->db->query("SELECT * FROM issu_item");
        foreach ($query->result_array() as $row) {
            $data[] = $row;
        }
        return $data;
    }

    //This function will return Inventory item issued user title by id
    public function issued_user($id) {
        $data = array();
        $query = $this->db->query("SELECT username FROM users WHERE id=$id");
        foreach ($query->result_array() as $row) {
            $data = $row['username'];
        }
        return $data;
    }

    //This function will return inventory item title
    public function item_title($id) {
        $data = array();
        $query = $this->db->query("SELECT item FROM inve_item WHERE id=$id");
        foreach ($query->result_array() as $row) {
            $data = $row['item'];
        }
        return $data;
    }

    //This function will show
    public function single_issu_item($id) {
        $data = array();
        $query = $this->db->query("SELECT * FROM issu_item WHERE id = $id");
        foreach ($query->result_array() as $row) {
            $data[] = $row;
        }
        return $data;
    }

    //This function will show item stock quantity
    public function item_stock($id) {
        $data = array();
        $query = $this->db->query("SELECT quantity FROM inve_item WHERE id=$id");
        foreach ($query->result_array() as $row) {
            $data = $row['quantity'];
        }
        return $data;
    }

}
