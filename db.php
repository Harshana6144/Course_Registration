<?php
    class crud{
        public static function conect()
        {
           try {
            $con=new PDO('mysql:localhost=host; dbname=course_registration','root','');
            return $con;
        
           } catch (PDOException $error1) {
            echo 'Something went wrong'.$error1->getMessage();
           }catch(Exception $error2){
            echo 'Generic error'.$error2->getMessage();
           }
        }

        public static function Selectdata()
        {
            $data=array();
            $p=crud::conect()->prepare('SELECT * FROM details_table');
            $p->execute();
            $data=$p->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }

    }
?>