<?php

define( 'k_format_zero', 0 );
define( 'k_format_big_e', 1 );
define( 'k_format_little_e', 2 );

define( 'k_storage_local', 0 );
define( 'k_storage_map', 1 );
define( 'k_storage_world', 2 );
define( 'k_storage_global', 3 );

class file_t {
   public $path;
   public $load_path;
   public $text;
   public $length;
   public $pos;
   public $line;
   public $column;
   public $ch;
}

class type_t {
   public $name;
   public function __construct( $name ) {
      $this->name = $name;
   }
}

class dim_t {
   public $size;
   public $element_size;
   public function __construct() {
      $this->size = 0;
      $this->element_size = 0;
   }
}

class initial_t {
   const type_expr = 0;
   const type_jump = 1;
   public $type;
   public $value;
   public function __construct() {
      $this->type = self::type_expr;
      $this->value = 0;
   }
}

class params_t {
   const type_script = 0;
   const type_func = 1;

   public $pos;
   public $type;
   public $vars;
   public $has_default;

   public function __construct() {
      $this->pos = null;
      $this->type = self::type_script;
      $this->vars = array();
      $this->has_default = false;
   }
}

class scope_t {
   public $names;
   public $index;
   public $index_high;
   public function __construct() {
      $this->names = array();
      $this->index = 0;
      $this->index_high = 0;
   }
}

class node_t {
   const type_constant = 0;
   const type_literal = 1;
   const type_unary = 2;
   const type_binary = 3;
   const type_call = 4;
   const type_subscript = 5;
   const type_expr = 6;
   const type_var = 7;
   const type_script = 8;
   const type_script_jump = 9;
   const type_func = 10;
   const type_if = 11;
   const type_jump = 12;
   const type_while = 13;
   const type_return = 14;
   const type_for = 15;
   const type_switch = 16;
   const type_case = 17;
   const type_param = 18;
   public $type;
}

class constant_t {
   public $node;
   public $value;
   public $pos;
   public function __construct() {
      $this->node = new node_t();
      $this->node->type = node_t::type_constant;
      $this->value = 0;
      $this->pos = null;
   }
}

class literal_t {
   public $node;
   public $value;
   public function __construct() {
      $this->node = new node_t();
      $this->node->type = node_t::type_literal;
   }
}

class unary_t {
   const op_none = 0;
   const op_minus = 1;
   const op_log_not = 2;
   const op_bit_not = 3;
   const op_pre_inc = 4;
   const op_pre_dec = 5;
   const op_post_inc = 6;
   const op_post_dec = 7;
   public $node;
   public $op;
   public $operand;
   public function __construct() {
      $this->node = new node_t();
      $this->node->type = node_t::type_unary;
   }
}

class binary_t {
   const op_assign = 1;
   const op_assign_add = 2;
   const op_assign_sub = 3;
   const op_assign_mul = 4;
   const op_assign_div = 5;
   const op_assign_mod = 6;
   const op_assign_shift_l = 7;
   const op_assign_shift_r = 8;
   const op_assign_bit_and = 9;
   const op_assign_bit_xor = 10;
   const op_assign_bit_or = 11;
   const op_log_or = 12;
   const op_log_and = 13;
   const op_bit_or = 14;
   const op_bit_xor = 15;
   const op_bit_and = 16;
   const op_equal = 17;
   const op_not_equal = 18;
   const op_less_than = 19;
   const op_less_than_equal = 20;
   const op_more_than = 21;
   const op_more_than_equal = 22;
   const op_shift_l = 23;
   const op_shift_r = 24;
   const op_add = 25;
   const op_sub = 26;
   const op_mul = 27;
   const op_div = 28;
   const op_mod = 29;
   public $node;
   public $op;
   public $lside;
   public $rside;
   public function __construct() {
      $this->node = new node_t();
      $this->node->type = node_t::type_binary;
   }
}

class call_t {
   public $node;
   public $func;
   public $args;
   public function __construct() {
      $this->node = new node_t();
      $this->node->type = node_t::type_call;
      $this->func = null;
      $this->args = array();
   }
}

class subscript_t {
   public $node;
   public $operand;
   public $index;
   public function __construct() {
      $this->node = new node_t();
      $this->node->type = node_t::type_subscript;
      $this->operand = null;
      $this->index = null;
   }
}

class expr_t {
   public $node;
   public $root;
   public $pos;
   public $folded;
   public $value;
   public function __construct() {
      $this->node = new node_t();
      $this->node->type = node_t::type_expr;
   }
}

class var_t {
   public $node;
   public $pos;
   public $name;
   public $dim;
   public $storage;
   public $index;
   public $size;
   public $initial;
   public function __construct() {
      $this->node = new node_t();
      $this->node->type = node_t::type_var;
      $this->index = 0;
   }
}

class script_t {
   const type_closed = 0;
   const type_open = 1;
   const type_respawn = 2;
   const type_death = 3;
   const type_enter = 4;
   const type_pickup = 5;
   const type_blue_return = 6;
   const type_red_return = 7;
   const type_white_return = 8;
   const type_lightning = 9;
   const type_unloading = 10;
   const type_disconnect = 11;
   const type_return = 12;

   const flag_net = 1;
   const flag_clientside = 2;

   public $node;
   public $pos;
   public $number;
   public $num_params;
   public $type;
   public $flags;
   public $offset;
   public $body;
   public $size;

   public function __construct() {
      $this->node = new node_t();
      $this->node->type = node_t::type_script;
      $this->pos = null;
      $this->number = 0;
      $this->num_params = 0;
      $this->type = self::type_closed;
      $this->flags = 0;
      $this->offset = 0;
      $this->body = null;
      $this->size = 0;
   }
}

class block_t {
   const flow_going = 0;
   const flow_dead = 1;
   const flow_jump = 2;
   public $in_script;
   public $in_loop;
   public $in_switch;
   public $is_break;
   public $is_continue;
   public $is_return;
   public $stmts;
   public $flow;
   public $prev;
   public function __construct() {
      $this->in_script = false;
      $this->in_loop = false;
      $this->in_switch = false;
      $this->is_break = false;
      $this->is_continue = false;
      $this->is_return = false;
      $this->stmts = array();
      $this->flow = self::flow_going;
      $this->prev = null;
   }
}

class jump_t {
   const type_break = 0;
   const type_continue = 1;
   public $node;
   public $type;
   public $offset;
   public function __construct() {
      $this->node = new node_t();
      $this->node->type = node_t::type_jump;
      $this->type = self::type_break;
      $this->offset = 0;
   }
}

class script_jump_t {
   const terminate = 0;
   const suspend = 1;
   const restart = 2;
   public $node;
   public $type;
   public function __construct() {
      $this->node = new node_t();
      $this->node->type = node_t::type_script_jump;
      $this->type = self::terminate;
   }
}

class return_t {
   public $node;
   public $expr;
   public function __construct() {
      $this->node = new node_t();
      $this->node->type = node_t::type_return;
      $this->expr = null;
   }
}

class param_t {
   public $node;
   public $pos;
   public function __construct() {
      $this->node = new node_t();
      $this->node->type = node_t::type_param;
      $this->pos = null;
   }
}

class func_t {
   const type_aspec = 0;
   const type_ext = 1;
   const type_ded = 2;
   const type_format = 3;
   const type_user = 4;
   const type_internal = 5;
   public $node;
   public $pos;
   public $type;
   // Whether returns a value.
   public $value;
   public $min_params;
   public $max_params;
   public $detail;
   public function __construct() {
      $this->node = new node_t();
      $this->node->type = node_t::type_func;
      $this->type = self::type_user;
      $this->value = false;
      $this->detail = array();
   }
}

class if_t {
   public $node;
   public $expr;
   public $body;
   public $else_body;
   public function __construct() {
      $this->node = new node_t();
      $this->node->type = node_t::type_if;
      $this->expr = null;
      $this->body = null;
      $this->else_body = null;
   }
}

class while_t {
   const type_while = 0;
   const type_until = 1;
   const type_do_while = 2;
   const type_do_until = 3;
   public $node;
   public $type;
   public $expr;
   public $body;
   public function __construct() {
      $this->node = new node_t();
      $this->node->type = node_t::type_while;
      $this->type = self::type_while;
      $this->expr = null;
      $this->body = null;
   }
}

class for_t {
   public $node;
   public $init;
   public $cond;
   public $post;
   public $body;
   public function __construct() {
      $this->node = new node_t();
      $this->node->type = node_t::type_for;
      $this->init = null;
   }
}

class switch_t {
   public $node;
   public $cond;
   public $cases;
   public $cases_sorted;
   public $default_case;
   public $body;
   public function __construct() {
      $this->node = new node_t();
      $this->node->type = node_t::type_switch;
      $this->cond = null;
      $this->cases = array();
      $this->cases_sorted = array();
      $this->body = null;
   }
}

class case_t {
   public $node;
   public $expr;
   public $pos;
   public function __construct() {
      $this->node = new node_t();
      $this->node->type = node_t::type_case;
   }
}

class module_t {
   public $name;
   public $vars;
   public $arrays;
   public $scripts;
   public $funcs;
   public $imports;
   public function __construct() {
      $this->vars = array();
      $this->arrays = array();
      $this->scripts = array();
      $this->funcs = array();
      $this->imports = array();
   }
}