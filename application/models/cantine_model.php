<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
<<<<<<< HEAD
class Cantine_model extends CI_Model {
=======
class cantine_model extends CI_Model {
>>>>>>> 8f7d4ddc636b367c61a1f5066210b613fff93d47
    public function getPlats($idmenu){
        $sql = "select Plat.id, Plat.intitule, Plat.code, sum(quantite) as quantite
        from Plat join Commande
        on Plat.id = Commande.idPlat
        where Commande.idMenu='%s'
        group by Plat.id, Plat.intitule, Plat.code";
        $sql = sprintf($sql,$idmenu);
        $query = $this->db->query($sql);
        $array = array();
        foreach($query->result_array() as $row){
			$array[]=$row;
		}
        return $array;
    }
}
?>
