<?php
    class Programmer
    {
        public function code()
        {
            return 'coding';
        }
    }
    class Tester
    {
        public function test()
        {
            return 'testing';
        }
    }
    class ProjectManagement
    {
        public function process($member)
        {
            if ($member instanceof Programmer) {
                $member->code();
            } elseif ($member instanceof Tester) {
                $member->test();
            };
            throw new Exception('Invalid input member');
        }
    }

//////////////// SOLUCION 4B

    interface Workable
    {
    public function process();
    }

    class ProgrammerimplementsWorkable
    {
        public function code()
        {
            return'coding';
        }

        public function process()
        {
        $this->code();
        }
    }

    class TesterimplementsWorkable
    {
        public function test()
        {
            return'testing';
        }

        public function process()
        {
        $this->test();
        }
        
    }

    class ProjectManagement
    {
        public function process(Workable $member)
        {
            $member->process();
        }
    }