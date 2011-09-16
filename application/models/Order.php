<?php
class Application_Model_Order
{
    //name data borrowed from: http://www.ruf.rice.edu/~pound/#scripts
    protected $first = 
        'Aaron Adam Adrian Alan Alejandro Alex Allen Andrew Andy Anthony Art 
        Arthur Barry Bart Ben Benjamin Bill Bobby Brad Bradley Brendan Brett 
        Brian Bruce Bryan Carlos Chad Charles Chris Christopher Chuck Clay 
        Corey Craig Dan Daniel Darren Dave David Dean Dennis Denny Derek Don 
        Doug Duane Edward Eric Eugene Evan Frank Fred Gary Gene George Gordon 
        Greg Harry Henry Hunter Ivan Jack James Jamie Jason Jay Jeff Jeffrey 
        Jeremy Jim Joe Joel John Jonathan Joseph Justin Keith Ken Kevin Larry 
        Logan Marc Mark Matt Matthew Michael Mike Nat Nathan Patrick Paul Perry 
        Peter Philip Phillip Randy Raymond Ricardo Richard Rick Rob Robert Rod 
        Roger Ross Ruben Russell Ryan Sam Scot Scott Sean Shaun Stephen Steve 
        Steven Stewart Stuart Ted Thomas Tim Toby Todd Tom Troy Victor Wade 
        Walter Wayne William';

    protected $last = 
        'Adams Adamson Adler Akers Akin Aleman Alexander Allen Allison Allwood 
        Anderson Andreou Anthony Appelbaum Applegate Arbore Arenson Armold 
        Arntzen Askew Athanas Atkinson Ausman Austin Averitt Avila-Sakar 
        Badders Baer Baggerly Bailliet Baird Baker Ball Ballentine Ballew Banks 
        Baptist-Nguyen Barbee Barber Barchas Barcio Bardsley Barkauskas Barnes 
        Barnett Barnwell Barrera Barreto Barroso Barrow Bart Barton Bass Bates 
        Bavinger Baxter Bazaldua Becker Beeghly Belforte Bellamy Bellavance 
        Beltran Belusar Bennett Benoit Bensley Berger Berggren Bergman Berry 
        Bertelson Bess Beusse Bickford Bierner Bird Birdwell Bixby Blackmon 
        Blackwell Blair Blankinship Blanton Block Blomkalns Bloomfield Blume 
        Boeckenhauer Bolding Bolt Bolton Book Boucher Boudreau Bowman Boyd ';
    
    
    
    public static function getOrder($id)
    {
        return new self($id);
    }
    
    public function __construct($order = null)
    {
        $order = (string) $order;
        //persist the data through session
        $session = new Zend_Session_Namespace('model');
        if(empty($session->$order)){
            $data = array();
            $data['name'] = $this->getFakeName();
            $data['amount'] = rand(100, 1000);
            $data['total'] = rand(200, 500);
            $data['order'] = $order;
            $data['date'] = new DateTime(rand(1,4) . ' days ago');
            
            $session->$order = $data;
        }
        
        $this->data = $session->$order;
    }
    
    protected function getFakeName()
    {
        $first = preg_split('/\s+/mi', $this->first);
        $last = preg_split('/\s+/mi', $this->last);
        
        return $first[array_rand($first)] . ' ' . $last[array_rand($last)];
        
    }
    
    public function __get($name)
    {
        if(isset($this->data[$name])){
            return $this->data[$name];
        }
        
        return null;
    }
}