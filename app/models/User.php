<?php 


class User
{
	private $db;

	public function __construct()
	{
		$this->db = new Database;
	}

	# Register USER
	public function register($data)
	{
		$this->db->query('INSERT INTO users (first_name, last_name, username, email, password) VALUES (:first_name, :last_name, :username, :email, :password)');
		# Bind values
		$this->db->bind(':first_name', $data['first_name']);
		$this->db->bind(':last_name', $data['last_name']);
		$this->db->bind(':username', $data['username']);
		$this->db->bind(':email', $data['email']);
		$this->db->bind(':password', $data['password']);
		# Execute
		if($this->db->execute())
		{
			return true;
		} else {
			return false;
		}
	}

	# Login USER:
	public function login($email=null, $username=null, $password)
	{
		$this->db->query('SELECT * FROM users WHERE (email = :email OR username = :username)');
		$this->db->bind(':email', $email);
		$this->db->bind(':username', $username);

		$row = $this->db->single();
		$hashed_password = $row->password;
		if(password_verify($password, $hashed_password))
		{
			return $row;
		} else
		{
			return false;
		}
	}

	# Find USER by Email:
	public function findUserByEmail($email)
	{
		$this->db->query('SELECT * FROM users WHERE email = :email');
		$this->db->bind(':email', $email);

		$row = $this->db->single();

		// Check row
		if($this->db->rowCount() > 0)
		{
			return true;
		} else 
		{
			return false;
		}
	}

	# Find USER by Username:
	public function findUserByUsername($username)
	{
		$this->db->query('SELECT * FROM users WHERE username = :username');
		$this->db->bind(':username', $username);

		$row = $this->db->single();

		// Check row
		if($this->db->rowCount() > 0)
		{
			return true;
		} else 
		{
			return false;
		}
	}

	# Get USER by id:
	public function getUserById($id)
	{
		$this->db->query('SELECT * FROM users WHERE id = :id');
		$this->db->bind(':id', $id);

		$row = $this->db->single();

		// Check row
		if($this->db->rowCount() > 0)
		{
			return $row;
		} else 
		{
			return false;
		}
	}
}