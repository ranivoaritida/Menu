<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Etudiant_model extends CI_model {
    public function inscription($etudiant){
        $sql = "insert into Etudiant(numEtu, pwd, nom, naissance, token) values('%s', sha1('%s'), '%s', '%s', sha1('%s'))";
        $sql = sprintf($sql,$etudiant['numEtu'],$etudiant['pwd'],$etudiant['nom'],$etudiant['naissance'],$etudiant['numEtu']);
        $this->db->query($sql);
    }

    public function connexion($numEtu, $pwd){
        $sql = "select * from Etudiant where numEtu='%s' and pwd=sha1('%s')";
        $sql = sprintf($sql, $numEtu, $pwd);
        $query = $this->db->query($sql);
        $etudiant = $query->row_array();
        if($etudiant['numEtu']==null){
            return "numEtu ou password incorrect";
        }else{
            $row["token"] = $etudiant['token'];
            $query = $this->db->insert('Connexion',$row);
            return $etudiant['token'];
        }     
    }

    public function modify($token, $nom, $naissance){
        $sql = "update Etudiant set nom='%s', naissance='%s' where token='%s'";
        $sql = sprintf($sql, $nom, $naissance, $token);
        $this->db->query($sql);
    }
}
?>