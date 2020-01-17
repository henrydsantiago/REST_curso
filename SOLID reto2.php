<?php

    interface UnderlingInterface
    {
        public function program();
        public function filetps();
        public function collate();
    }
   
    class Underling implements UnderlingInterface
    {
        public function program()
        {
            return 'Program initech systems to deposit fractions of pennies to private account';
        }

        public function filetps()
        {
            return 'Place cover sheet on TPS report before going out';
        }

        public function collate()
        {
            return 'Collect and combine texts, information, and figures in proper order.';
        }
    }

    class Consultant implements UnderlingInterface
    {
        public function program()
        {
            return 'Outsource task to India';
        }

        public function filetps()
        {
            return 'Place cover sheet on TPS report before going out';
        }

        public function collate()
        {
            return null;
        }
    }

    class Lumbergh
    {
        protected $underling;

        public function __construct(UnderlingInterface $underling)
        {
            $this->underling = $underling;
        }

        public function harass()
        {
            $this->underling->program();
            $this->underling->filetps();
            $this->underling->collate();
        }
    }

 //////  MI SOLUCION

 interface UnderlingInterface
 {
     public function program();
     public function filetps();

 }

 interface CollatableInterface{
    public function collate();
 }

 class Underling implements UnderlingInterface, CollatableInterface
 {
     public function program()
     {
         return 'Program initech systems to deposit fractions of pennies to private account';
     }

     public function filetps()
     {
         return 'Place cover sheet on TPS report before going out';
     }

     public function collate()
     {
         return 'Collect and combine texts, information, and figures in proper order.';
     }
 }

 class Consultant implements UnderlingInterface
 {
     public function program()
     {
         return 'Outsource task to India';
     }

     public function filetps()
     {
         return 'Place cover sheet on TPS report before going out';
     }
 }

 class Lumbergh
 {
     protected $underling;

     public function __construct(UnderlingInterface $underling)
     {
         $this->underling = $underling;
     }

     public function harass()
     {
         $this->underling->program();
         $this->underling->filetps();
         $this->underling->collate();
     }
 }


    /////////// SOLUCION

/****** Interface Segregation Principle *****/


interface UnderlingInterface
{
    public function program();

    public function filetps();

}

interface Collateable
{
    public function collate();
}

class Underling implements UnderlingInterface, Collateable
{
    public function program()
    {
        return'Program initech systems to deposit fractions of pennies to private account';
    }

    public function filetps()
    {
        return'Place cover sheet on TPS report before going out';
    }

    public function collate()
    {
        return'Collect and combine texts, information, and figures in proper order.';
    }
}

class ConsultantimplementsUnderlingInterface
{
    public function program()
    {
        return'Outsource task to India';
    }

    public function filetps()
    {
        return'Place cover sheet on TPS report before going out';
    }

}

class Lumbergh
{
    protected $underling;

    public function __construct(UnderlingInterface $underling)
    {
        $this->underling = $underling;
    }

    public function harass()
    {
        $this->underling->program();
        $this->underling->filetps();
        $this->underling->collate();
    }
}
