<?php
    namespace TECWEB\MYAPI;

    use TECWEB\MYAPI\DataBase as DataBase;
    require_once __DIR__ . '/DataBase.php';

    class Products extends DataBase{

        private $data = NULL; 

        public function __construct($user='root', $pass='pantera44', $db){
            $this->data =array();
            parent::__construct($user, $pass, $db); 

        }
    
        public function list(){
        //se crea el arreglo que se va a devolver en forma de json 
        $this->data = array(); 

        //se realiza la quey de busqueda y al mismo tiempo se valida si hubo resultados 
        if($result = $this->conexion->query("SELECT * FROM productos WHERE eliminado=0")){
            //se obtiene resultados 
            $rows = $result->fetch_all(MYSQLI_ASSOC); 
            if(!is_null($rows)){
                //se codifican a utf-8 los datos y se mapean al arreglo de respuesta 
                foreach ($rows as $num => $row){
                    foreach($row as $key => $value){
                        $this->data[$num][$key] = $value; 
                    }
                }
            }
            $result->free(); 
        } else {
            die('Quey Error: ' .mysqli_error($this->conexion)); 
        }
        $this->conexion->close(); 
         return json_encode($this->data, JSON_PRETTY_PRINT);
    }


    public function add($object){
        //se crea el arreglo que va a devolver en forma de json
        $this->data = array(
            'status' => 'error', 
            'message' => 'Ya existe un producto con ese nombre'

        ); 

        $sql = "SELECT * FROM productos WHERE nombre = '{$object->nombre}' AND eliminado =0"; 
        $result = $this->conexion->query($sql); 

        if ($result->num_rows == 0) {
            $this->conexion->set_charset("utf8");
            $sql = "INSERT INTO productos VALUES (null, '{$object->nombre}', '{$object->marca}', '{$object->modelo}', {$object->precio}, '{$object->detalles}', {$object->unidades}, '{$object->imagen}', 0)";
            if($this->conexion->query($sql)){
                $this->data['status'] =  "success";
                $this->data['message'] =  "Producto agregado";
            } else {
                $this->data['message'] = "ERROR: No se ejecuto $sql. " . mysqli_error($this->conexion);
            }

        }
        $result->free();
        $this->conexion->close();
       return json_encode($this->data, JSON_PRETTY_PRINT);
    }

    public function delete(string $id){
        $this->data = array(
            'status' => 'error',
            'message' => 'La consulta falló'
        ); 
            // SE REALIZA LA QUERY DE BÚSQUEDA Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS
            $sql = "UPDATE productos SET eliminado=1 WHERE id = {$id}";
            if ( $this->conexion->query($sql) ) {
                $this->data['status'] =  "success";
                $this->data['message'] =  "Producto eliminado";
            } else {
                $this->data['message'] = "ERROR: No se ejecuto $sql. " . mysqli_error($this->conexion);
            }
            $this->conexion->close();
            return json_encode($this->data, JSON_PRETTY_PRINT);
        } 

    public function edit($jsonOBJ){
        $this->data = array(
            'status'  => 'error',
            'message' => 'La consulta falló'
        );
        $sql =  "UPDATE productos SET nombre='{$jsonOBJ->nombre}', marca='{$jsonOBJ->marca}',";
        $sql .= "modelo='{$jsonOBJ->modelo}', precio={$jsonOBJ->precio}, detalles='{$jsonOBJ->detalles}',"; 
        $sql .= "unidades={$jsonOBJ->unidades}, imagen='{$jsonOBJ->imagen}' WHERE id={$jsonOBJ->id}";
            if ( $this->conexion->query($sql) ) {
                $this->data['status'] =  "success";
                $this->data['message'] =  "Producto actualizado";
            } else {
                $this->data['message'] = "ERROR: No se ejecuto $sql. " . mysqli_error($this->conexion);
            }
            $this->conexion->close();
            return  json_encode($this->data, JSON_PRETTY_PRINT);
        }
    
    public function search(){
        $this->data = array();
        if( isset($_GET['search']) ) {
            $search = $_GET['search'];
            $sql = "SELECT * FROM productos WHERE (id = '{$search}' OR nombre LIKE '%{$search}%' OR marca LIKE '%{$search}%' OR detalles LIKE '%{$search}%') AND eliminado = 0";
            if ( $result = $this->conexion->query($sql) ) {
                $rows = $result->fetch_all(MYSQLI_ASSOC);
                if(!is_null($rows)) {
                    foreach($rows as $num => $row) {
                        foreach($row as $key => $value) {
                            //$this->data[$num][$key] = utf8_encode($value);
                            $this->data[$num][$key] = $value;
                        }
                    }
                }
                $result->free();
            } else {
                die('Query Error: '.mysqli_error($this->conexion));
            }
            $this->conexion->close();
        } 
        return json_encode($this->data, JSON_PRETTY_PRINT);
    }

    public function single($id){
    $this->data = array();
    if( isset($id) ) {
        $sql = "SELECT * FROM productos WHERE id = {$id}";
        if ( $result = $this->conexion->query($sql) ) {
            $row = $result->fetch_assoc();
            if(!is_null($row)) {
                foreach($row as $key => $value) {
                   // $this->data[$key] = utf8_encode($value);
                    $this->data[$key] = $value;
                }
            }
            $result->free();
        } else {
            die('Query Error: '.mysqli_error($this->conexion));
        }
        $this->conexion->close();
    }
    return json_encode($this->data, JSON_PRETTY_PRINT);
}


public function singleByName($name){
    $this->data = array();
    if( isset($name) ) {
        $sql = "SELECT * FROM productos WHERE nombre LIKE '%{$name}%' AND eliminado = 0";
        if ( $result = $this->conexion->query($sql) ) {
            $rows = $result->fetch_all(MYSQLI_ASSOC);
            if(!is_null($rows)) {
                foreach($rows as $num => $row) {
                    foreach($row as $key => $value) {
                        //$this->data[$num][$key] = utf8_encode($value);
                        $this->data[$num][$key] = $value;
                    }
                }
            }
            $result->free();
        } else {
            die('Query Error: '.mysqli_error($this->conexion));
        }
        $this->conexion->close();
    } 
    return json_encode($this->data, JSON_PRETTY_PRINT);
    
}





      public function getData(){
        return json_encode($this->data, JSON_PRETTY_PRINT); 
    }

}
?>