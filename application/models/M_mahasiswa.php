<?php
// extends class Model
class M_mahasiswa extends CI_Model{
// response jika field ada yang kosong
    public function empty_response()
    {
        $response['status']  = 502;
        $response['error']   = true;
        $response['message'] = 'Field tidak boleh kosong';
        return $response;
    }

    // function untuk insert data ke tabel tb_mahasiswa
    public function tambah_mahasiswa($nama, $jenis_kelamin, $no_hp)
    {
        if(empty($nama) || empty($jenis_kelamin) || empty($no_hp)){
              return $this->empty_response();
        }else{
            $data = array(
              "nama"=>$nama,
              "jenis_kelamin"=>$jenis_kelamin,
              "no_hp"=>$no_hp
            );

            $insert = $this->db->insert("tb_mahasiswa", $data);
            if($insert){
                $response['status']=200;
                $response['error']=false;
                $response['message']='Data mahasiswa ditambahkan.';
                return $response;
            }else{
                $response['status']=502;
                $response['error']=true;
                $response['message']='Data mahasiswa gagal ditambahkan.';
                return $response;
            }
        }
    }

    // mengambil semua data mahasiswa
    public function all_mahasiswa()
    {
        $all = $this->db->get('tb_mahasiswa')->result();
        return $all;      
    }

    // mengambil detail data mahasiswa / per id_mahasiswa
    public function detail_mahasiswa($id_mahasiswa)
    {
        $detail = $this->db->select('*')->where('id_mahasiswa', $id_mahasiswa)->get('tb_mahasiswa')->row_array();
        return $detail;
    }

    // hapus data mahasiswa
    public function hapus_mahasiswa($id_mahasiswa)
    {
        if($id_mahasiswa == ''){
          return $this->empty_response();
        }else{
            $where = array(
              "id_mahasiswa"=>$id_mahasiswa
            );
        
            $this->db->where($where);
            $hapus = $this->db->delete("tb_mahasiswa");
            if($hapus){
                $response['status']=200;
                $response['error']=false;
                $response['message']='Data mahasiswa dihapus.';
                return $response;
            }else{
                $response['status']=502;
                $response['error']=true;
                $response['message']='Data mahasiswa gagal dihapus.';
                return $response;
            }
        }
    }

    // update mahasiswa
    public function update_mahasiswa($id_mahasiswa, $nama, $jenis_kelamin, $no_hp)
    {
        if($id_mahasiswa == '' || empty($nama) || empty($jenis_kelamin) || empty($no_hp)){
          return $this->empty_response();
        }else{
          $where = array(
            "id_mahasiswa"=>$id_mahasiswa
          );
          
          $set = array(
            "nama"=>$nama,
            "jenis_kelamin"=>$jenis_kelamin,
            "no_hp"=>$no_hp
          );
          $this->db->where($where);
          $update = $this->db->update("tb_mahasiswa",$set);
            if($update){
              $response['status']=200;
              $response['error']=false;
              $response['message']='Data mahasiswa diubah.';
              return $response;

            }else{
              $response['status']=502;
              $response['error']=true;
              $response['message']='Data mahasiswa gagal diubah.';
              return $response;
            }
        }
    }
}
?>