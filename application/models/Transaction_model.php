<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction_model extends CI_Model
{
    private $_table = "transactions";

    public $id;
    public $total_price;
    public $amount_paid;
    public $change;
    public $user_id;

    public function rules()
    {
        return [
            ['field' => 'total_price',
            'label' => 'Total Price',
			'rules' => 'required|greater_than[0]'],
			
            ['field' => 'amount_paid',
            'label' => 'Bayar',
			'rules' => 'required|greater_than[0]'],
			
            ['field' => 'change',
            'label' => 'Kembalian',
            'rules' => 'required|greater_than_equal_to[0]'],
            
            ['field' => 'user_id',
            'label' => 'User Id',
            'rules' => 'required']
        ];
    }

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }
    
    public function getById($id)
    {
        return $this->db->get_where($this->_table, ["id" => $id])->row();
    }

    public function save()
    {
		$post = $this->input->post();
		$this->id = uniqid();
		$this->total_price = $post["total_price"];
		$this->user_id = $post["user_id"];
		$this->amount_paid = $post["amount_paid"];
		$this->change = $post["change"];
        $this->db->insert($this->_table, $this);
		$i=0;
		$transDetails = [];
		$prod_id = "";
		$amount = 0;
		$subprice = 0;
		foreach ($post as $key=>$val):
			if($key == "total_price") break;
			if($i % 4 == 0){
				$prod_id=$val;
			}elseif($i % 4 == 1){
				$prod_name = $val;
			}elseif($i % 4 == 2){
				$amount = $val;
			}elseif($i % 4 == 3){
				$subprice = $val;
				$details = array(
					'transaction_id' => $this->id,
					'prod_id' => $prod_id,
					'prod_name' => $prod_name,
					'amount' => $amount,
					'subprice' => $subprice
				);
				array_push($transDetails, $details);
				$this->db->insert("transaction_details", $details);
			}
			$i +=1;
		endforeach;
		return array(
			'transDetails'=> $transDetails,
			'total_price'=>$this->total_price,
			'amount_paid'=>$this->amount_paid,
			'change'=>$this->change,
			'user_id'=>$this->user_id,
			'id'=>$this->id
		);
    }

    public function delete($id)
    {
		$this->db->delete("transaction_details", array("transaction_id" => $id));
        return $this->db->delete($this->_table, array("id" => $id));
	}

}
