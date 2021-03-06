<?php

namespace Adnduweb\Ci4_ecommerce\Controllers\Front;

use CodeIgniter\API\ResponseTrait;
use Adnduweb\Ci4_ecommerce\Entities\Cart;
use Adnduweb\Ci4_ecommerce\Entities\Order;
use Adnduweb\Ci4_ecommerce\Entities\Carrier;
use Adnduweb\Ci4_ecommerce\Entities\Customer;
use Adnduweb\Ci4_ecommerce\Models\CartModel;
use Adnduweb\Ci4_ecommerce\Models\OrderModel;
use Adnduweb\Ci4_ecommerce\Models\CarriersModel;
use Adnduweb\Ci4_ecommerce\Models\CustomerModel;

class FrontEcommerceController extends \App\Controllers\Front\FrontController
{

    public $name_module = 'ecommerce';

    protected $Authcustomer;
    /**
     * @var Authcustomer
     */
    protected $config;

    /**
     * @var \CodeIgniter\Session\Session
     */
    protected $session;


    public function __construct()
    {
        parent::__construct();
        $this->config = config('Authcustomer');
        $this->Authcustomer = service('authenticationcustomer');

        if ($this->Authcustomer->check() == false) {
            return redirect()->to('signin');
        }
    }
    public function index()
    {
        //Silent
    }
}
