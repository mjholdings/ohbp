<?php
class User_model extends MY_Model {
	protected $_table = 'users';
	public $register_rules = array(
		'firstname' => array(
			'field' => 'firstname',
			'label' => 'first name',
			'rules' => 'trim|required|xss_clean'
		),
		'lastname' => array(
			'field' => 'lastname',
			'label' => 'last name',
			'rules' => 'trim|required|xss_clean'
		),
		'email' => array(
			'field' => 'email',
			'label' => 'email',
			'rules' => 'trim|required|valid_email|callback_unique_email|xss_clean'
		),
		'username' => array(
			'field' => 'username',
			'label' => 'username',
			'rules' => 'trim|required|callback_unique_username|xss_clean'
		),
		'password' => array(
			'field' => 'password',
			'label' => 'password',
			'rules' => 'trim|required|matches[cpassword]|xss_clean'
		),
		'cpassword' => array(
			'field' => 'cpassword',
			'label' => 'confirm password',
			'rules' => 'trim|required|matches[password]|xss_clean'
		),
		'address' => array(
			'field' => 'address',
			'label' => 'address',
			'rules' => 'trim|required|xss_clean'
		),
		'state' => array(
			'field' => 'state',
			'label' => 'state',
			'rules' => 'trim|required'
		),
		'country' => array(
			'field' => 'country',
			'label' => 'country',
			'rules' => 'trim|required'
		),
		'paypal_email' => array(
			'field' => 'paypal_email',
			'label' => 'paypal email',
			'rules' => 'trim|required|valid_email|callback_unique_email|xss_clean'
		),
		'phone_number' => array(
			'field' => 'phone_number',
			'label' => 'phone number',
			'rules' => 'trim|required|regex_match[/^[0-9]{10}$/]'
		),
		'alternate_phone_number' => array(
			'field' => 'alternate_phone_number',
			'label' => 'alternate phone number',
			'rules' => 'trim|required|regex_match[/^[0-9]{10}$/]'
		)
	);
	public $login_rules = array(
		'username' => array(
			'field' => 'username',
			'label' => 'username',
			'rules' => 'trim|required'
		),
		'password' => array(
			'field' => 'password',
			'label' => 'password',
			'rules' => 'trim|required'
		)
	);
	public $profile_rules = array(
		'firstname' => array(
			'field' => 'firstname',
			'label' => 'firstname',
			'rules' => 'trim|required'
		),
		'lastname' => array(
			'field' => 'lastname',
			'label' => 'lastname',
			'rules' => 'trim|required'
		),
		'email' => array(
			'field' => 'email',
			'label' => 'email',
			'rules' => 'trim|required|valid_email'
		)
	);
	public $password_rules = array(
		'current_password' => array(
			'field' => 'current_password',
			'label' => 'current password',
			'rules' => 'trim|required|callback_password_check'
		),
		'new_password' => array(
			'field' => 'new_password',
			'label' => 'new password',
			'rules' => 'trim|required'
		),
		'confirm_newpassword' => array(
			'field' => 'confirm_newpassword',
			'label' => 'confirm password',
			'rules' => 'trim|required|matches[new_password]'
		)
	);

	function login($username) {
		return $this->db->where('username', $username)->or_where('email', $username)
			->get('users')->row_array();
	}

	function getCountries() {
		return $this->db->select('id,name')->from('countries')->get()->result_array();
	}
	function getState($country_id) {
		return $this->db->select('id,name')->from('states')->where('country_id', $country_id)->get()->result_array();
	}
	function update_user_login($user_id) {
		return $this->db->where('id', $user_id)->update('users', array('online' => '1'));
	}
	function update_user($user_id, $url) {
		return $this->db->where('id', $user_id)->update('users', $url);
	}

	function get_user_by_id($usr_id) {
		return $this->db->get_where('users', array('id' => $usr_id))->row_array();
	}
	function get_user_by_type($type) {
		return $this->db->get_where('users', array('type' => $type))->row_array();
	}

	function checkmail($mail) {
		return $this->db->get_where('users', array('email' => $mail))->row_array();
	}
	function checkuser($username) {
		return $this->db->get_where('users', array('username' => $username))->row_array();
	}

	function getUserCountry() {
		$this->db->select('count(*) as num, countries.name');
		$this->db->from('users');
		$this->db->group_by('users.country');
		$this->db->join('countries', 'users.country=countries.id');
		$query = $this->db->get();
		return $query->result();
	}

	function getUserCountryUserId($user_id) {
		$this->db->select('countries.name,countries.name,sortname');
		$this->db->from('users');
		$this->db->join('countries', 'users.country=countries.id');
		$this->db->where('users.id', $user_id);
		$query = $this->db->get();
		return $query->row_array();
	}
	function custom_query() {
	}
	function getAllNotification($user_id = null) {
		$this->db->from('notification');
		if (!empty($user_id)) {
			$this->db->where('notification_view_user_id', $user_id);
		}
		$this->db->where('notification_is_read', 0);
		$this->db->order_by("notification_created_date", "desc");
		$query = $this->db->get();
		return $query->result_array();
	}
	function getAllNotificationPaging($notification_viewfor = null, $user_id = null, $limit, $start) {
		$this->db->from('notification');
		$this->db->limit($limit, $start);
		if (!empty($notification_viewfor)) {
			$this->db->where('notification_viewfor', $notification_viewfor);
		}
		if (!empty($user_id)) {
			$this->db->where(" (notification_view_user_id = {$user_id} OR notification_view_user_id = 'all')  ", NULL, false);
		}

		$this->db->order_by("notification_created_date", "desc");
		$data['notifications'] = $this->db->get()->result_array();

		$this->db->from('notification');
		if (!empty($user_id)) {
			$this->db->where(" (notification_view_user_id = {$user_id} OR notification_view_user_id = 'all')  ", NULL, false);
		}
		if (!empty($notification_viewfor)) {
			$this->db->where('notification_viewfor', $notification_viewfor);
		}
		$data['total'] = $this->db->count_all_results();
		return $data;
	}

	/*
	* user group 
	*/
	function checkgroup($group_name, $id) {
		$where['group_name'] = $group_name;
		if (!empty($id)) {
			$where['id !='] = $id;
		}
		return $this->db->get_where('user_groups', $where)->row_array();
	}

	function groupinsert($data) {
		return $this->db->insert('user_groups', $data);
	}

	function update_group($id, $data) {
		return  $this->db->update('user_groups', $data, ['id' => $id]);
	}

	function getgrouplist() {
		return $this->db->query('select user_groups.*, COUNT(integration_tools.id) as tools_count, integration_tools.allow_groups, users.groups, COUNT(users.id) as users_count from user_groups left join integration_tools ON FIND_IN_SET(user_groups.id, integration_tools.allow_groups) left join users ON FIND_IN_SET(user_groups.id, users.groups) GROUP BY user_groups.id ORDER BY user_groups.created_at DESC')->result();
	}

	function getDefaultGroup() {
		return $this->db->get_where('user_groups', ['is_default' => 1])->row();
	}

	function getgroupdetails($id) {
		return $this->db->get_where('user_groups', ['id' => $id])->row();
	}

	function setStarForUser() {
		$get_user_star_3_query = "SELECT order_products.refer_id FROM order_products INNER JOIN `order` ON order_products.order_id = `order`.id WHERE `order`.`status` = 1 AND order_products.refer_id > 1 GROUP BY EXTRACT(month FROM `order`.created_at), order_products.refer_id HAVING SUM(order_products.total) >= 30000000 AND SUM(order_products.total) < 50000000 ORDER BY EXTRACT(month FROM `order`.created_at);";

		$get_user_star_4_query = "SELECT order_products.refer_id FROM order_products INNER JOIN `order` ON order_products.order_id = `order`.id WHERE `order`.`status` = 1 AND order_products.refer_id > 1 GROUP BY EXTRACT(month FROM `order`.created_at), order_products.refer_id HAVING SUM(order_products.total) >= 50000000 AND SUM(order_products.total) < 100000000 ORDER BY EXTRACT(month FROM `order`.created_at);";

		$get_user_star_5_query = "SELECT order_products.refer_id FROM order_products INNER JOIN `order` ON order_products.order_id = `order`.id WHERE `order`.`status` = 1 AND order_products.refer_id > 1 GROUP BY EXTRACT(month FROM `order`.created_at), order_products.refer_id HAVING SUM(order_products.total) >= 100000000 ORDER BY EXTRACT(month FROM `order`.created_at);";

		$results_user_star_3 = $this->db->query($get_user_star_3_query)->result_array();
		$results_user_star_4 = $this->db->query($get_user_star_4_query)->result_array();
		$results_user_star_5 = $this->db->query($get_user_star_5_query)->result_array();

		if (count($results_user_star_3) > 0) {
			$arr_id_user_star_3 = [];
			foreach ($results_user_star_3 as $result_user_star_3) {
				array_push($arr_id_user_star_3, $result_user_star_3['refer_id']);
			}
			$update_user_star_3 = "UPDATE users SET user_star = 3 WHERE id IN (" . implode(",", $arr_id_user_star_3) . ")";
			$this->db->query($update_user_star_3);
		}

		if (count($results_user_star_4) > 0) {
			$arr_id_user_star_4 = [];
			foreach ($results_user_star_4 as $result_user_star_4) {
				array_push($arr_id_user_star_4, $result_user_star_4['refer_id']);
			}
			$update_user_star_4 = "UPDATE users SET user_star = 4 WHERE id IN (" . implode(",", $arr_id_user_star_4) . ")";
			$this->db->query($update_user_star_4);
		}

		if (count($results_user_star_5) > 0) {
			$arr_id_user_star_5 = [];
			foreach ($results_user_star_5 as $result_user_star_5) {
				array_push($arr_id_user_star_5, $result_user_star_5['refer_id']);
			}
			$update_user_star_5 = "UPDATE users SET user_star = 5 WHERE id IN (" . implode(",", $arr_id_user_star_5) . ")";
			$this->db->query($update_user_star_5);
		}
	}

	/*
	* User
	*/
	// Lấy toàn bộ cây dưới dạng mảng
	public function getTree() {
		$query = $this->db->get('users');
		return $query->result_array();
	}

	// Lấy thông tin của một node
	public function getNode($id) {
		$query = $this->db->get_where('users', array('id' => $id));
		return $query->row_array();
	}

	// Lấy các con của một node
	public function getChildren($id) {
		$query = $this->db->get_where('users', array('refid' => $id));
		return $query->result_array();
	}

	// Lấy toàn bộ phần con bằng cách đệ quy
	public function getAllDescendants($id) {
		$descendants = [];

		$children = $this->getChildren($id);
		foreach ($children as $child) {
			$descendants[] = $child['id'];
			$grandChildren = $this->getAllDescendants($child['id']);
			$descendants = array_merge($descendants, $grandChildren);
		}

		return $descendants;
	}

	/*
	* Branch 
	*/
	function checkbranch($branch_name, $id) {
		$where['name'] = $branch_name;
		if (!empty($id)) {
			$where['id !='] = $id;
		}
		return $this->db->get_where('branch', $where)->row_array();
	}

	function branchinsert($data) {
		return $this->db->insert('branch', $data);
	}

	function update_branch($id, $data) {
		return  $this->db->update('branch', $data, ['id' => $id]);
	}

	function getbranchlist() {
		return $this->db->query('select * from branch')->result();
	}

	function getDefaultBranch() {
		return $this->db->get_where('branch', ['is_default' => 1])->row();
	}

	function getbranchdetails($id) {
		return $this->db->get_where('branch', ['id' => $id])->row();
	}

	// TÍNH THƯỞNG ***************
	public function calculate_commissions() {

		// Kết nối đến cơ sở dữ liệu
		$db = $this->db;

		// Xóa dữ liệu cũ trong bảng user_commission
		$db->truncate('user_comission');

		// Lấy tất cả các mục trong bảng user_revenue
		$query = "SELECT * FROM user_revenue";
		$user_revenues = $db->query($query)->result();

		foreach ($user_revenues as $revenue) {
			$user_id = $revenue->user_id;					// người dùng doanh thu
			$order_id = $revenue->order_id;					// đơn hàng
			$product_id = $revenue->product_id;				// sản phẩm
			$personal_revenue = $revenue->revenue;			// doanh thu cá nhân
			$direct_revenue = $revenue->revenue_direct;		// doanh thu trực tiếp
			$indirect_revenue = $revenue->revenue_indirect; // doanh thu gián tiếp
			$created_time = $revenue->created_time;			// thời gian đơn hàng

			// Lấy cấp độ hiện tại của user
			$current_level = $this->get_user_current_rank($user_id);

			if ($current_level == 0) {
				$current_level = 1;
			}

			// Lấy setting của riêng level hiện tại
			$current_settings = $this->get_user_current_setting($current_level);

			// Điều kiện			

			// Kiểm tra điều kiện doanh thu cá nhân cho cấp độ hiện tại
			if ($personal_revenue >= $current_settings->minimum_earning) {
				$condition = true;
			} else {
				$condition = false;
			}

			// Kiểm tra số lượng thành viên tuyển dụng trực tiếp
			$user_recruitment = $this->get_user_recruitment($user_id);
			if ($user_recruitment->total_direct >= $current_settings->recruitment_number) {
				$condition = true;
			} else {
				$condition = false;
			}


			// Kiểm tra số thành viên cấp độ trực tiếp yêu cầu
			if ($this->check_direct_member_level($user_id, $current_settings->recruitment_number, $current_settings->recruitment_level) || $current_settings->recruitment_level == 0) {
				$condition = true;
			} else {
				$condition = false;
			}

			// Đủ điều kiện thì cho thưởng
			if ($condition) {
				// Tính thưởng doanh thu cá nhân
				if ($current_settings->sale_comission_rate > 0) {
					$commission_value = $personal_revenue * ($current_settings->sale_comission_rate / 100);
					$this->update_commission($user_id, $order_id, $product_id, $created_time, 'sales_personal', 'percentage', $commission_value);
				}

				// tính thưởng tiền mặt trực tiếp
				if ($current_settings->bonus > 0) {
					$this->update_commission($user_id, $order_id, $product_id, $created_time, 'sales_fixed', 'fixed', $current_settings->bonus);
				}

				// Tính thưởng doanh thu trực tiếp
				if ($current_settings->sale_comission_direct > 0) {
					$commission_value = $direct_revenue * ($current_settings->sale_comission_direct / 100);
					$this->update_commission($user_id, $order_id, $product_id, $created_time, 'sales_direct', 'percentage', $commission_value);
				}

				// Tính thưởng doanh thu gián tiếp
				if ($current_settings->sale_comission_indirect > 0) {
					$commission_value = $indirect_revenue * ($current_settings->sale_comission_indirect / 100);
					$this->update_commission($user_id, $order_id, $product_id, $created_time, 'sales_indirect', 'percentage', $commission_value);
				}
			}
		}

		// Tính thưởng đồng chia ============

		// Lấy tất cả các mục trong bảng users
		$query = "SELECT * FROM users";
		$user_all = $db->query($query)->result();

		foreach ($user_all as $user_item) {

			$current_time = date('Y-m-d H:i:s');

			// Lấy cấp độ hiện tại của user
			$current_level = $this->get_user_current_rank($user_id);

			if ($current_level == 0) {
				$current_level = 1;
			}

			// Lấy setting của riêng level hiện tại
			$current_settings = $this->get_user_current_setting($current_level);

			if ($current_settings->shared_comission_rate > 0) {
				$commission_value = $this->get_total_revenue() * ($current_settings->shared_comission_rate / 100);
				$this->update_commission($user_item->user_id, 0, 0, $current_time, 'shared_commission', 'percentage', $commission_value);
			}
		}
	}

	// Hàm lấy tổng doanh thu
	public function get_total_revenue() {
		$this->db->select_sum('revenue');
		$result = $this->db->get('user_revenue')->row();

		if ($result) {
			return $result->revenue; // Trả về tổng doanh thu
		} else {
			return 0; // Trả về 0 nếu không có bản ghi nào
		}
	}

	// Hàm lấy cấp độ hiện tại của user
	private function get_user_current_rank($user_id) {
		// Lấy user_level từ bảng user_rank với user_id cụ thể
		$this->db->select('user_level');
		$this->db->from('user_rank');
		$this->db->where('user_id', $user_id);
		$result = $this->db->get()->row();

		if ($result) {
			return $result->user_level; // Trả về user_level nếu tìm thấy
		} else {
			return 0; // Trả về null nếu không tìm thấy user_id
		}
	}

	// Hàm lấy settings hiện tại của user
	private function get_user_current_setting($user_level) {
		// Lấy bản ghi đầu tiên từ bảng award_level với level_number bằng user_level
		$this->db->select('*');
		$this->db->from('award_level');
		$this->db->where('level_number', $user_level);
		$this->db->limit(1);
		$result = $this->db->get()->row();

		return $result; // Trả về bản ghi đầu tiên thỏa mãn điều kiện
	}

	// Hàm lấy thông tin tuyển dụng của user
	private function get_user_recruitment($user_id) {
		$this->db->where('user_id', $user_id);
		$query = $this->db->get('user_recruitment');
		return $query->result();
	}

	// Hàm kiểm tra cấp độ thành viên trực tiếp
	public function check_direct_member_level($user_id, $required_number, $required_level) {
		
		// Lấy danh sách ids_direct từ bảng user_recruitment
		$this->db->select('ids_direct');
		$this->db->from('user_recruitment');
		$this->db->where('user_id', $user_id);
		$user_recruitment = $this->db->get()->row();

		if (empty($user_recruitment)) {
			return false; // Không có dữ liệu cho user_id này
		}

		$ids_direct = explode(',', $user_recruitment->ids_direct);


		// kiểm tra required_number = 0 và required_level > 0 xét cấp, không kiểm tra số lượng
		if ($required_number == 0 && $required_level > 0) {
			foreach ($ids_direct as $direct_id) {
				// Lấy user_level từ bảng user_rank
				$this->db->select('user_level');
				$this->db->from('user_rank');
				$this->db->where('user_id', $direct_id);
				$user_rank = $this->db->get()->row();

				if (!empty($user_rank) && $user_rank->user_level == $required_level || ($user_rank->user_level == 0 && $required_level == 1)) {
					return true; // Tìm thấy một thành viên trực tiếp với cấp độ yêu cầu
				}
			}
			return false; // Không tìm thấy thành viên nào thỏa mãn cấp độ yêu cầu
		}

		// kiểm tra required_number > 0 và required_level = 0 không xét cấp, kiểm tra số lượng
		if ($required_level == 0 && $required_number > 0) {
			return count($ids_direct) >= $required_number; // Kiểm tra số lượng thành viên trực tiếp
		}

		// kiểm tra required_number > 0 và required_level > 0 xét cấp và Kiểm tra số lượng
		if ($required_number > 0 && $required_level > 0) {
			$count = 0;
			foreach ($ids_direct as $direct_id) {
				// Lấy user_level từ bảng user_rank
				$this->db->select('user_level');
				$this->db->from('user_rank');
				$this->db->where('user_id', $direct_id);
				$user_rank = $this->db->get()->row();

				if (!empty($user_rank) && $user_rank->user_level == $required_level || ($user_rank->user_level == 0 && $required_level == 1)) {
					$count++;
					if ($count >= $required_number) {
						return true; // Đủ số lượng thành viên với cấp độ yêu cầu
					}
				}
			}
			return false; // Không đủ số lượng thành viên với cấp độ yêu cầu
		}

		// kiểm tra required_number = 0 và required_level = 0
		if ($required_number == 0 && $required_level == 0) {
			return true;
		}

		return false;
	}

	// Hàm cập nhật thông tin hoa hồng vào bảng user_commission
	private function update_commission($user_id, $order_id, $product_id, $created_time, $method, $type, $value) {
		$data = array(
			'user_id' => $user_id,
			'order_id' => $order_id,
			'product_id' => $product_id,
			'comission_method' => $method,
			'comission_type' => $type,
			'comission_value' => $value,
			'created_at' => $created_time,
			'comission_date' => date('Y-m-d H:i:s')
		);
		$this->db->insert('user_comission', $data);
	}

}
