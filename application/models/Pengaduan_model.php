<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengaduan_model extends CI_Model
{

    public function get_by_user($userId)
    {
        $this->db->select('p.*, k.nama_kategori, COUNT(b.id_balasan) as jumlah_balasan');
        $this->db->from('pengaduan p');
        $this->db->join('kategori k', 'p.id_kategori = k.id_kategori', 'left');
        $this->db->join('balasan b', 'p.id_pengaduan = b.id_pengaduan', 'left');
        $this->db->where('p.user_id', $userId);
        $this->db->group_by('p.id_pengaduan');
        $this->db->order_by('p.date', 'DESC');
        return $this->db->get()->result();
    }

    public function get_by_id($id)
    {
        $this->db->select('p.*, k.nama_kategori, COALESCE(s.nama, g.nama) as nama_pelapor');
        $this->db->from('pengaduan as p');
        $this->db->join('kategori as k', 'p.id_kategori = k.id_kategori', 'left');
        $this->db->join('siswa as s', 'p.user_id = s.user_id', 'left');
        $this->db->join('guru as g', 'p.user_id = g.user_id', 'left');
        $this->db->where('p.id_pengaduan', $id);
        return $this->db->get()->row();
    }

    public function insert($data)
    {
        return $this->db->insert('pengaduan', $data);
    }

    public function update($id, $data)
    {
        $this->db->where('id_pengaduan', $id);
        return $this->db->update('pengaduan', $data);
    }

    public function delete($id)
    {
        $this->db->where('id_pengaduan', $id);
        return $this->db->delete('pengaduan');
    }

    public function get_valid_pengaduan_for_edit_delete($id, $userId)
    {
        $this->db->select('p.*, k.nama_kategori');
        $this->db->from('pengaduan p');
        $this->db->join('kategori k', 'p.id_kategori = k.id_kategori', 'left');
        $this->db->join('balasan b', 'p.id_pengaduan = b.id_pengaduan', 'left');
        $this->db->where('p.id_pengaduan', $id);
        $this->db->where('p.user_id', $userId);
        $this->db->where('b.id_balasan IS NULL');
        return $this->db->get()->row();
    }

    public function get_pengaduan_detail_for_user($id_pengaduan, $user_id)
    {
        $this->db->select('p.*, k.nama_kategori, COUNT(b.id_balasan) as jumlah_balasan');
        $this->db->from('pengaduan p');
        $this->db->join('kategori k', 'p.id_kategori = k.id_kategori', 'left');
        $this->db->join('balasan b', 'p.id_pengaduan = b.id_pengaduan', 'left');
        $this->db->where('p.id_pengaduan', $id_pengaduan);
        $this->db->where('p.user_id', $user_id);
        $this->db->group_by('p.id_pengaduan');
        $pengaduan = $this->db->get()->row();

        if ($pengaduan) {
            $this->db->select('b.*, s.status');
            $this->db->from('balasan as b');
            $this->db->join('status as s', 'b.id_status = s.id_status');
            $this->db->where('b.id_pengaduan', $id_pengaduan);
            $balasan = $this->db->get()->result();

            $pengaduan->balasan = $balasan;

            foreach ($pengaduan->balasan as &$balas) {
                $balas->kepuasan = $this->db
                    ->get_where('kepuasan', ['id_balasan' => $balas->id_balasan])
                    ->row();
            }
        }

        return $pengaduan;
    }
}