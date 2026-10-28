<?php
// $this->load->model('Kunjung');
$poli = $this->input->get('poli');
// $kategori = $this->input->get('kategori'); 
$atanggal = date("Y-m-d", strtotime($this->input->get('atanggal')));
$btanggal = $atanggal;
$akses = self::akses_menu();
$nik = $akses->nik;
$induk = $akses->induk;
// $uni = $indux;
if ($induk == 'HJR') {
    $uni = 'HJ';
} else {
    $uni = $induk;
}


if ($induk == 'RND') {

    if ($poli == 'SM') {
        $query = "
    SELECT a.no_reg, a.nama, a.tgl_masuk, a.jam_masuk,a.poli_id as bangsal,if(a.no_reg is not null,'V',' ') as awal, 
    if(b.no_reg is not null,'V',' ') as anak, 
    if(c.no_reg is not null,'V',' ') as geri,
    if(d.no_reg is not null,'V',' ') as gine,
    if(e.no_reg is not null,'V',' ') as imun,
    if(f.no_reg is not null,'V',' ') as bid,
    if(g.no_reg is not null,'V',' ') as neo,
    if(h.no_reg is not null,'V',' ') as rema,
    if(i.no_reg is not null,'V',' ') as post,
    if(j.no_reg is not null,'V',' ') as resum
    FROM rme.askep_inap_awal a 
         LEFT JOIN  rme.askep_inap_tambahan_anak b on b.no_reg=a.no_reg and b.tgl_masuk=a.tgl_masuk
         LEFT JOIN  rme.askep_inap_tambahan_geriatri c on c.no_reg=a.no_reg and c.tgl_masuk=a.tgl_masuk 
         LEFT JOIN  rme.askep_inap_tambahan_ginekologi d on d.no_reg=a.no_reg and d.tgl_masuk=a.tgl_masuk
         LEFT JOIN  rme.askep_inap_tambahan_imunologi_terganggu e on e.no_reg=a.no_reg and e.tgl_masuk=a.tgl_masuk
         LEFT JOIN  rme.askep_inap_tambahan_kebidanan f on f.no_reg=a.no_reg and f.tgl_masuk=a.tgl_masuk
         LEFT JOIN  rme.askep_inap_tambahan_neonatus g on g.no_reg=a.no_reg and g.tgl_masuk=a.tgl_masuk
         LEFT JOIN  rme.askep_inap_tambahan_remaja h on h.no_reg=a.no_reg and h.tgl_masuk=a.tgl_masuk
         LEFT JOIN  rme.askep_post_partum i on i.no_reg=a.no_reg and i.tgl_masuk=a.tgl_masuk
         LEFT JOIN  rme.askep_inap_summary j on j.no_reg=a.no_reg and j.tgl_masuk=a.tgl_masuk
         LEFT JOIN 
         (select rme.soap_inap.no_reg,rme.soap_inap.tgl_masuk,date(rme.soap_inap.tgl_keluar) as tgl_keluar from rme.soap_inap where rme.soap_inap.resume ='1' group by rme.soap_inap.no_reg,rme.soap_inap.tgl_masuk) ax  
         on ax.no_reg=a.no_reg and ax.tgl_masuk=a.tgl_masuk
         where ax.tgl_keluar='$atanggal' 
         group by a.tgl_masuk, a.no_reg
         order by a.poli_id desc 
    ";
    } else {
        $query = "
        SELECT a.no_reg, a.nama, a.tgl_masuk, a.jam_masuk,a.poli_id as bangsal,if(a.no_reg is not null,'V',' ') as awal, 
        if(b.no_reg is not null,'V',' ') as anak, 
        if(c.no_reg is not null,'V',' ') as geri,
        if(d.no_reg is not null,'V',' ') as gine,
        if(e.no_reg is not null,'V',' ') as imun,
        if(f.no_reg is not null,'V',' ') as bid,
        if(g.no_reg is not null,'V',' ') as neo,
        if(h.no_reg is not null,'V',' ') as rema,
        if(i.no_reg is not null,'V',' ') as post,
        if(j.no_reg is not null,'V',' ') as resum
        FROM rme.askep_inap_awal a 
             LEFT JOIN  rme.askep_inap_tambahan_anak b on b.no_reg=a.no_reg and b.tgl_masuk=a.tgl_masuk
             LEFT JOIN  rme.askep_inap_tambahan_geriatri c on c.no_reg=a.no_reg and c.tgl_masuk=a.tgl_masuk 
             LEFT JOIN  rme.askep_inap_tambahan_ginekologi d on d.no_reg=a.no_reg and d.tgl_masuk=a.tgl_masuk
             LEFT JOIN  rme.askep_inap_tambahan_imunologi_terganggu e on e.no_reg=a.no_reg and e.tgl_masuk=a.tgl_masuk
             LEFT JOIN  rme.askep_inap_tambahan_kebidanan f on f.no_reg=a.no_reg and f.tgl_masuk=a.tgl_masuk
             LEFT JOIN  rme.askep_inap_tambahan_neonatus g on g.no_reg=a.no_reg and g.tgl_masuk=a.tgl_masuk
             LEFT JOIN  rme.askep_inap_tambahan_remaja h on h.no_reg=a.no_reg and h.tgl_masuk=a.tgl_masuk
             LEFT JOIN  rme.askep_post_partum i on i.no_reg=a.no_reg and i.tgl_masuk=a.tgl_masuk
             LEFT JOIN  rme.askep_inap_summary j on j.no_reg=a.no_reg and j.tgl_masuk=a.tgl_masuk
             LEFT JOIN 
             (select rme.soap_inap.no_reg,rme.soap_inap.tgl_masuk,date(rme.soap_inap.tgl_keluar) as tgl_keluar from rme.soap_inap where rme.soap_inap.resume ='1' group by rme.soap_inap.no_reg,rme.soap_inap.tgl_masuk) ax  
             on ax.no_reg=a.no_reg and ax.tgl_masuk=a.tgl_masuk
             where ax.tgl_keluar='$atanggal' and a.poli_id = '$poli'
             group by a.tgl_masuk, a.no_reg
            ";
    }
    //  pre($query);
    $riwayat = DB::connection('slave')->select($query);
    // $riwayat = DB::select($query);
    $rows = (array) null;
    if (!empty($riwayat)) {
        $no = 1;
        foreach ($riwayat as $row) {
            $row = (object) $row;
            $row->no = $no;
            $row->no_reg = $row->no_reg;
            $row->nama = $row->nama;
            $row->tgl_masuk = $row->tgl_masuk;
            if ($row->bangsal == 'ZM2') {
                $row->bangsal = 'ZAM 2';
            } else if ($row->bangsal == 'PRS') {
                $row->bangsal = 'ROUD';
            } else if ($row->bangsal == 'PRB') {
                $row->bangsal = 'ROUD BY';
            } else {
                $row->bangsal = $row->bangsal;
            }
            $no++;
            $rows[] = $row;
        }
    }

    $total = count($rows);
    $grand_total = 0;
    if ($total_soap = 0) {
        $total_tjp = 0;
    }
} else if ($induk == 'RMD') {

    if ($poli == 'SM') {
        $query = "
    SELECT a.no_reg, a.nama, a.tgl_masuk, a.jam_masuk,a.poli_id as bangsal,if(a.no_reg is not null,'V',' ') as awal, 
    if(b.no_reg is not null,'V',' ') as anak, 
    if(c.no_reg is not null,'V',' ') as geri,
    if(d.no_reg is not null,'V',' ') as gine,
    if(e.no_reg is not null,'V',' ') as imun,
    if(f.no_reg is not null,'V',' ') as bid,
    if(g.no_reg is not null,'V',' ') as neo,
    if(h.no_reg is not null,'V',' ') as rema,
    if(i.no_reg is not null,'V',' ') as post,
    if(j.no_reg is not null,'V',' ') as resum
    FROM rme.askep_inap_awal a 
         LEFT JOIN  rme.askep_inap_tambahan_anak b on b.no_reg=a.no_reg and b.tgl_masuk=a.tgl_masuk
         LEFT JOIN  rme.askep_inap_tambahan_geriatri c on c.no_reg=a.no_reg and c.tgl_masuk=a.tgl_masuk 
         LEFT JOIN  rme.askep_inap_tambahan_ginekologi d on d.no_reg=a.no_reg and d.tgl_masuk=a.tgl_masuk
         LEFT JOIN  rme.askep_inap_tambahan_imunologi_terganggu e on e.no_reg=a.no_reg and e.tgl_masuk=a.tgl_masuk
         LEFT JOIN  rme.askep_inap_tambahan_kebidanan f on f.no_reg=a.no_reg and f.tgl_masuk=a.tgl_masuk
         LEFT JOIN  rme.askep_inap_tambahan_neonatus g on g.no_reg=a.no_reg and g.tgl_masuk=a.tgl_masuk
         LEFT JOIN  rme.askep_inap_tambahan_remaja h on h.no_reg=a.no_reg and h.tgl_masuk=a.tgl_masuk
         LEFT JOIN  rme.askep_post_partum i on i.no_reg=a.no_reg and i.tgl_masuk=a.tgl_masuk
         LEFT JOIN  rme.askep_inap_summary j on j.no_reg=a.no_reg and j.tgl_masuk=a.tgl_masuk
         LEFT JOIN 
         (select rme.soap_inap.no_reg,rme.soap_inap.tgl_masuk,date(rme.soap_inap.tgl_keluar) as tgl_keluar from rme.soap_inap where rme.soap_inap.resume ='1' group by rme.soap_inap.no_reg,rme.soap_inap.tgl_masuk) ax  
         on ax.no_reg=a.no_reg and ax.tgl_masuk=a.tgl_masuk
         where ax.tgl_keluar='$atanggal' 
         group by a.tgl_masuk, a.no_reg
         order by a.poli_id desc 
    ";
    } else {
        $query = "
        SELECT a.no_reg, a.nama, a.tgl_masuk, a.jam_masuk,a.poli_id as bangsal,if(a.no_reg is not null,'V',' ') as awal, 
        if(b.no_reg is not null,'V',' ') as anak, 
        if(c.no_reg is not null,'V',' ') as geri,
        if(d.no_reg is not null,'V',' ') as gine,
        if(e.no_reg is not null,'V',' ') as imun,
        if(f.no_reg is not null,'V',' ') as bid,
        if(g.no_reg is not null,'V',' ') as neo,
        if(h.no_reg is not null,'V',' ') as rema,
        if(i.no_reg is not null,'V',' ') as post,
        if(j.no_reg is not null,'V',' ') as resum
        FROM rme.askep_inap_awal a 
             LEFT JOIN  rme.askep_inap_tambahan_anak b on b.no_reg=a.no_reg and b.tgl_masuk=a.tgl_masuk
             LEFT JOIN  rme.askep_inap_tambahan_geriatri c on c.no_reg=a.no_reg and c.tgl_masuk=a.tgl_masuk 
             LEFT JOIN  rme.askep_inap_tambahan_ginekologi d on d.no_reg=a.no_reg and d.tgl_masuk=a.tgl_masuk
             LEFT JOIN  rme.askep_inap_tambahan_imunologi_terganggu e on e.no_reg=a.no_reg and e.tgl_masuk=a.tgl_masuk
             LEFT JOIN  rme.askep_inap_tambahan_kebidanan f on f.no_reg=a.no_reg and f.tgl_masuk=a.tgl_masuk
             LEFT JOIN  rme.askep_inap_tambahan_neonatus g on g.no_reg=a.no_reg and g.tgl_masuk=a.tgl_masuk
             LEFT JOIN  rme.askep_inap_tambahan_remaja h on h.no_reg=a.no_reg and h.tgl_masuk=a.tgl_masuk
             LEFT JOIN  rme.askep_post_partum i on i.no_reg=a.no_reg and i.tgl_masuk=a.tgl_masuk
             LEFT JOIN  rme.askep_inap_summary j on j.no_reg=a.no_reg and j.tgl_masuk=a.tgl_masuk
             LEFT JOIN 
             (select rme.soap_inap.no_reg,rme.soap_inap.tgl_masuk,date(rme.soap_inap.tgl_keluar) as tgl_keluar from rme.soap_inap where rme.soap_inap.resume ='1' group by rme.soap_inap.no_reg,rme.soap_inap.tgl_masuk) ax  
             on ax.no_reg=a.no_reg and ax.tgl_masuk=a.tgl_masuk
             where ax.tgl_keluar='$atanggal' and a.poli_id = '$poli'
             group by a.tgl_masuk, a.no_reg
            ";
    }
    //  pre($query);
    $riwayat = DB::connection('slave')->select($query);
    // $riwayat = DB::select($query);
    $rows = (array) null;
    if (!empty($riwayat)) {
        $no = 1;
        foreach ($riwayat as $row) {
            $row = (object) $row;
            $row->no = $no;
            $row->no_reg = $row->no_reg;
            $row->nama = $row->nama;
            $row->tgl_masuk = $row->tgl_masuk;
            if ($row->bangsal == 'ZM2') {
                $row->bangsal = 'ZAM 2';
            } else if ($row->bangsal == 'PRS') {
                $row->bangsal = 'ROUD';
            } else if ($row->bangsal == 'PRB') {
                $row->bangsal = 'ROUD BY';
            } else {
                $row->bangsal = $row->bangsal;
            }
            $no++;
            $rows[] = $row;
        }
    }

    $total = count($rows);
    $grand_total = 0;
    if ($total_soap = 0) {
        $total_tjp = 0;
    }
} else if ($induk == 'PRS') {

    $query = "
    SELECT a.no_reg, a.nama,x.umur, a.tgl_masuk, a.jam_masuk,ri.kd_bangsal as bangsal,if(a.no_reg is not null,'V',' ') as awal, 
        if(b.no_reg is not null,'V',' ') as anak, 
        if(c.no_reg is not null,'V',' ') as geri,
        if(d.no_reg is not null,'V',' ') as gine,
        if(e.no_reg is not null,'V',' ') as imun,
        if(f.no_reg is not null,'V',' ') as bid,
        if(g.no_reg is not null,'V',' ') as neo,
        if(h.no_reg is not null,'V',' ') as rema,
        if(i.no_reg is not null,'V',' ') as post,
        if(j.no_reg is not null,'V',' ') as resum,
        if(k.no_reg is not null,'V',' ') as menul,
        if(w.no_reg is not null,'V',' ') as termi,
        if(l.no_reg is not null,'V',' ') as awalmd,
            if(ax.no_reg is not null,'V',' ') as resmd
            FROM rme.askep_inap_awal a 
             LEFT JOIN  
            ( select no_reg,tgl_masuk from rme.askep_inap_tambahan_anak where deleted is null) b on b.no_reg=a.no_reg and b.tgl_masuk=a.tgl_masuk
             LEFT JOIN  
             (select no_reg,tgl_masuk from rme.askep_inap_tambahan_geriatri where deleted is null) c on c.no_reg=a.no_reg and c.tgl_masuk=a.tgl_masuk 
             LEFT JOIN 
             (select no_reg,tgl_masuk from rme.askep_inap_tambahan_ginekologi where deleted is null ) d on d.no_reg=a.no_reg and d.tgl_masuk=a.tgl_masuk
             LEFT JOIN  
             (select no_reg,tgl_masuk from rme.askep_inap_tambahan_imunologi_terganggu where deleted is null) e on e.no_reg=a.no_reg and e.tgl_masuk=a.tgl_masuk
             LEFT JOIN  
             (select no_reg,tgl_masuk from rme.askep_inap_tambahan_kebidanan where deleted is null ) f on f.no_reg=a.no_reg and f.tgl_masuk=a.tgl_masuk
             LEFT JOIN  
              (select no_reg,tgl_masuk from rme.askep_inap_tambahan_neonatus where deleted is null ) g on g.no_reg=a.no_reg and g.tgl_masuk=a.tgl_masuk
             LEFT JOIN  
              (select no_reg,tgl_masuk from rme.askep_inap_tambahan_remaja where deleted is null ) h on h.no_reg=a.no_reg and h.tgl_masuk=a.tgl_masuk
             LEFT JOIN  
              (select no_reg,tgl_masuk from rme.askep_post_partum where deleted is null ) i on i.no_reg=a.no_reg and i.tgl_masuk=a.tgl_masuk
             LEFT JOIN  
              (select no_reg,tgl_masuk from rme.askep_inap_summary where deleted is null ) j on j.no_reg=a.no_reg and j.tgl_masuk=a.tgl_masuk
             LEFT JOIN  
              (select no_reg,tgl_masuk from rme.askep_inap_tambahan_penyakit_menular where deleted is null ) k on k.no_reg=a.no_reg and k.tgl_masuk=a.tgl_masuk
             left join ranap.inap ri  on ri.no_reg = a.no_reg and ri.tgl_masuk= a.tgl_masuk
             left join 
             (select rme.soap_inap.no_reg,rme.soap_inap.tgl_masuk,date(rme.soap_inap.tgl_keluar) as tgl_keluar,round(DATEDIFF(rme.soap_inap.tgl_masuk, rme.soap_inap.tgl_lahir)/365,0) as umur from rme.soap_inap  where rme.soap_inap.resume <> '1' and deleted is null group by rme.soap_inap.no_reg,rme.soap_inap.tgl_masuk) l 
             on l.no_reg=a.no_reg and l.tgl_masuk=a.tgl_masuk
             LEFT JOIN  
             (select no_reg,tgl_masuk from rme.askep_inap_tambahan_terminal where deleted is null ) w on w.no_reg=a.no_reg and w.tgl_masuk=a.tgl_masuk
             left join
             (select rme.askep_inap_awal.no_reg,rme.askep_inap_awal.tgl_masuk,floor(DATEDIFF(rme.askep_inap_awal.tgl_masuk, rsiklaten.pasien.tgl_lahir)/365) as umur, registered from rme.askep_inap_awal  left join rsiklaten.pasien on rsiklaten.pasien.no_reg=rme.askep_inap_awal.no_reg where  deleted is null group by rme.askep_inap_awal.no_reg,rme.askep_inap_awal.tgl_masuk) x
             on x.no_reg = a.no_reg and x.tgl_masuk =  a.tgl_masuk
             LEFT JOIN 
             (select rme.soap_inap.no_reg,rme.soap_inap.tgl_masuk,date(rme.soap_inap.tgl_keluar) as tgl_keluar from rme.soap_inap where rme.soap_inap.resume ='1' and deleted is null  group by rme.soap_inap.no_reg,rme.soap_inap.tgl_masuk) ax  
             on ax.no_reg=a.no_reg and ax.tgl_masuk=a.tgl_masuk
             where ri.kd_bangsal in ('VIP','ROBY') and a.tgl_masuk =ri.tgl_masuk
             group by a.tgl_masuk, a.no_reg
             order by ri.kd_bangsal desc 
        ";
    $riwayat = DB::select($query);
    $rows = (array) null;
    if (!empty($riwayat)) {
        $no = 1;
        foreach ($riwayat as $row) {
            $row = (object) $row;
            $row->no = $no;
            $row->no_reg = $row->no_reg;
            $row->nama = $row->nama;
            $row->tgl_masuk = $row->tgl_masuk;
            if (substr($row->bangsal, 0, 3) == 'ZM2') {
                $row->bangsal = 'ZAM 2';
            } else if (substr($row->bangsal, 0, 3)  == 'PRS') {
                $row->bangsal = 'ROUD';
            } else if (substr($row->bangsal, 0, 3) == 'PRB') {
                $row->bangsal = 'ROUD BY';
            } else if (substr($row->bangsal, 0, 3) == 'HJB') {
                $row->bangsal = 'HJ BY';
            } else if (substr($row->bangsal, 0, 3) == 'HJR') {
                $row->bangsal = 'HJR';
            } else {
                $row->bangsal = $row->bangsal;
            }
            $no++;
            $rows[] = $row;
        }
    }

    $total = count($rows);
    $grand_total = 0;
    if ($total_soap = 0) {
        $total_tjp = 0;
    }
} elseif ($induk == 'KBR') {
    $query = "
    SELECT a.no_reg, a.nama,x.umur, a.tgl_masuk, a.jam_masuk,ri.kd_bangsal as bangsal,if(a.no_reg is not null,'V',' ') as awal, 
        if(b.no_reg is not null,'V',' ') as anak, 
        if(c.no_reg is not null,'V',' ') as geri,
        if(d.no_reg is not null,'V',' ') as gine,
        if(e.no_reg is not null,'V',' ') as imun,
        if(f.no_reg is not null,'V',' ') as bid,
        if(g.no_reg is not null,'V',' ') as neo,
        if(h.no_reg is not null,'V',' ') as rema,
        if(i.no_reg is not null,'V',' ') as post,
        if(j.no_reg is not null,'V',' ') as resum,
        if(k.no_reg is not null,'V',' ') as menul,
        if(w.no_reg is not null,'V',' ') as termi,
        if(l.no_reg is not null,'V',' ') as awalmd,
            if(ax.no_reg is not null,'V',' ') as resmd
            FROM rme.askep_inap_awal a 
             LEFT JOIN  
            ( select no_reg,tgl_masuk from rme.askep_inap_tambahan_anak where deleted is null) b on b.no_reg=a.no_reg and b.tgl_masuk=a.tgl_masuk
             LEFT JOIN  
             (select no_reg,tgl_masuk from rme.askep_inap_tambahan_geriatri where deleted is null) c on c.no_reg=a.no_reg and c.tgl_masuk=a.tgl_masuk 
             LEFT JOIN 
             (select no_reg,tgl_masuk from rme.askep_inap_tambahan_ginekologi where deleted is null ) d on d.no_reg=a.no_reg and d.tgl_masuk=a.tgl_masuk
             LEFT JOIN  
             (select no_reg,tgl_masuk from rme.askep_inap_tambahan_imunologi_terganggu where deleted is null) e on e.no_reg=a.no_reg and e.tgl_masuk=a.tgl_masuk
             LEFT JOIN  
             (select no_reg,tgl_masuk from rme.askep_inap_tambahan_kebidanan where deleted is null ) f on f.no_reg=a.no_reg and f.tgl_masuk=a.tgl_masuk
             LEFT JOIN  
              (select no_reg,tgl_masuk from rme.askep_inap_tambahan_neonatus where deleted is null ) g on g.no_reg=a.no_reg and g.tgl_masuk=a.tgl_masuk
             LEFT JOIN  
              (select no_reg,tgl_masuk from rme.askep_inap_tambahan_remaja where deleted is null ) h on h.no_reg=a.no_reg and h.tgl_masuk=a.tgl_masuk
             LEFT JOIN  
              (select no_reg,tgl_masuk from rme.askep_post_partum where deleted is null ) i on i.no_reg=a.no_reg and i.tgl_masuk=a.tgl_masuk
             LEFT JOIN  
              (select no_reg,tgl_masuk from rme.askep_inap_summary where deleted is null ) j on j.no_reg=a.no_reg and j.tgl_masuk=a.tgl_masuk
             LEFT JOIN  
              (select no_reg,tgl_masuk from rme.askep_inap_tambahan_penyakit_menular where deleted is null ) k on k.no_reg=a.no_reg and k.tgl_masuk=a.tgl_masuk
             left join ranap.inap ri  on ri.no_reg = a.no_reg and ri.tgl_masuk= a.tgl_masuk
             left join 
             (select rme.soap_inap.no_reg,rme.soap_inap.tgl_masuk,date(rme.soap_inap.tgl_keluar) as tgl_keluar,round(DATEDIFF(rme.soap_inap.tgl_masuk, rme.soap_inap.tgl_lahir)/365,0) as umur from rme.soap_inap  where rme.soap_inap.resume <> '1' and deleted is null group by rme.soap_inap.no_reg,rme.soap_inap.tgl_masuk) l 
             on l.no_reg=a.no_reg and l.tgl_masuk=a.tgl_masuk
             LEFT JOIN  
             (select no_reg,tgl_masuk from rme.askep_inap_tambahan_terminal where deleted is null ) w on w.no_reg=a.no_reg and w.tgl_masuk=a.tgl_masuk
             left join
             (select rme.askep_inap_awal.no_reg,rme.askep_inap_awal.tgl_masuk,floor(DATEDIFF(rme.askep_inap_awal.tgl_masuk, rsiklaten.pasien.tgl_lahir)/365) as umur, registered from rme.askep_inap_awal  left join rsiklaten.pasien on rsiklaten.pasien.no_reg=rme.askep_inap_awal.no_reg where  deleted is null group by rme.askep_inap_awal.no_reg,rme.askep_inap_awal.tgl_masuk) x
             on x.no_reg = a.no_reg and x.tgl_masuk =  a.tgl_masuk
             LEFT JOIN 
             (select rme.soap_inap.no_reg,rme.soap_inap.tgl_masuk,date(rme.soap_inap.tgl_keluar) as tgl_keluar from rme.soap_inap where rme.soap_inap.resume ='1' and deleted is null  group by rme.soap_inap.no_reg,rme.soap_inap.tgl_masuk) ax  
             on ax.no_reg=a.no_reg and ax.tgl_masuk=a.tgl_masuk
             where ri.kd_bangsal in ('PIVV','PIC','PICV','PIC3','PIC2','PIC1','NC3V','NC33','NC32','NC31','NC2V','NC23','NC22','NC21','NCH','NC2H','NC2','NC3') and a.tgl_masuk =ri.tgl_masuk
             group by a.tgl_masuk, a.no_reg
             order by ri.kd_bangsal desc 
        ";
    $riwayat = DB::select($query);
    $rows = (array) null;
    if (!empty($riwayat)) {
        $no = 1;
        foreach ($riwayat as $row) {
            $row = (object) $row;
            $row->no = $no;
            $row->no_reg = $row->no_reg;
            $row->nama = $row->nama;
            $row->tgl_masuk = $row->tgl_masuk;
            if (substr($row->bangsal, 0, 3) == 'ZM2') {
                $row->bangsal = 'ZAM 2';
            } else if (substr($row->bangsal, 0, 3)  == 'PRS') {
                $row->bangsal = 'ROUD';
            } else if (substr($row->bangsal, 0, 3) == 'PRB') {
                $row->bangsal = 'ROUD BY';
            } else if (substr($row->bangsal, 0, 3) == 'HJB') {
                $row->bangsal = 'HJ BY';
            } else if (substr($row->bangsal, 0, 3) == 'HJR') {
                $row->bangsal = 'HJR';
            } else {
                $row->bangsal = $row->bangsal;
            }
            $no++;
            $rows[] = $row;
        }
    }

    $total = count($rows);
    $grand_total = 0;
    if ($total_soap = 0) {
        $total_tjp = 0;
    }
} elseif ($induk == 'MGR') {
    $query = "
    SELECT a.no_reg, a.nama,x.umur, a.tgl_masuk, a.jam_masuk,ri.kd_bangsal as bangsal,if(a.no_reg is not null,'V',' ') as awal, 
        if(b.no_reg is not null,'V',' ') as anak, 
        if(c.no_reg is not null,'V',' ') as geri,
        if(d.no_reg is not null,'V',' ') as gine,
        if(e.no_reg is not null,'V',' ') as imun,
        if(f.no_reg is not null,'V',' ') as bid,
        if(g.no_reg is not null,'V',' ') as neo,
        if(h.no_reg is not null,'V',' ') as rema,
        if(i.no_reg is not null,'V',' ') as post,
        if(j.no_reg is not null,'V',' ') as resum,
        if(k.no_reg is not null,'V',' ') as menul,
        if(w.no_reg is not null,'V',' ') as termi,
        if(l.no_reg is not null,'V',' ') as awalmd,
            if(ax.no_reg is not null,'V',' ') as resmd
            FROM rme.askep_inap_awal a 
             LEFT JOIN  
            ( select no_reg,tgl_masuk from rme.askep_inap_tambahan_anak where deleted is null) b on b.no_reg=a.no_reg and b.tgl_masuk=a.tgl_masuk
             LEFT JOIN  
             (select no_reg,tgl_masuk from rme.askep_inap_tambahan_geriatri where deleted is null) c on c.no_reg=a.no_reg and c.tgl_masuk=a.tgl_masuk 
             LEFT JOIN 
             (select no_reg,tgl_masuk from rme.askep_inap_tambahan_ginekologi where deleted is null ) d on d.no_reg=a.no_reg and d.tgl_masuk=a.tgl_masuk
             LEFT JOIN  
             (select no_reg,tgl_masuk from rme.askep_inap_tambahan_imunologi_terganggu where deleted is null) e on e.no_reg=a.no_reg and e.tgl_masuk=a.tgl_masuk
             LEFT JOIN  
             (select no_reg,tgl_masuk from rme.askep_inap_tambahan_kebidanan where deleted is null ) f on f.no_reg=a.no_reg and f.tgl_masuk=a.tgl_masuk
             LEFT JOIN  
              (select no_reg,tgl_masuk from rme.askep_inap_tambahan_neonatus where deleted is null ) g on g.no_reg=a.no_reg and g.tgl_masuk=a.tgl_masuk
             LEFT JOIN  
              (select no_reg,tgl_masuk from rme.askep_inap_tambahan_remaja where deleted is null ) h on h.no_reg=a.no_reg and h.tgl_masuk=a.tgl_masuk
             LEFT JOIN  
              (select no_reg,tgl_masuk from rme.askep_post_partum where deleted is null ) i on i.no_reg=a.no_reg and i.tgl_masuk=a.tgl_masuk
             LEFT JOIN  
              (select no_reg,tgl_masuk from rme.askep_inap_summary where deleted is null ) j on j.no_reg=a.no_reg and j.tgl_masuk=a.tgl_masuk
             LEFT JOIN  
              (select no_reg,tgl_masuk from rme.askep_inap_tambahan_penyakit_menular where deleted is null ) k on k.no_reg=a.no_reg and k.tgl_masuk=a.tgl_masuk
             left join ranap.inap ri  on ri.no_reg = a.no_reg and ri.tgl_masuk= a.tgl_masuk
             left join 
             (select rme.soap_inap.no_reg,rme.soap_inap.tgl_masuk,date(rme.soap_inap.tgl_keluar) as tgl_keluar,round(DATEDIFF(rme.soap_inap.tgl_masuk, rme.soap_inap.tgl_lahir)/365,0) as umur from rme.soap_inap  where rme.soap_inap.resume <> '1' and deleted is null group by rme.soap_inap.no_reg,rme.soap_inap.tgl_masuk) l 
             on l.no_reg=a.no_reg and l.tgl_masuk=a.tgl_masuk
             LEFT JOIN  
             (select no_reg,tgl_masuk from rme.askep_inap_tambahan_terminal where deleted is null ) w on w.no_reg=a.no_reg and w.tgl_masuk=a.tgl_masuk
             left join
             (select rme.askep_inap_awal.no_reg,rme.askep_inap_awal.tgl_masuk,floor(DATEDIFF(rme.askep_inap_awal.tgl_masuk, rsiklaten.pasien.tgl_lahir)/365) as umur, registered from rme.askep_inap_awal  left join rsiklaten.pasien on rsiklaten.pasien.no_reg=rme.askep_inap_awal.no_reg where  deleted is null group by rme.askep_inap_awal.no_reg,rme.askep_inap_awal.tgl_masuk) x
             on x.no_reg = a.no_reg and x.tgl_masuk =  a.tgl_masuk
             LEFT JOIN 
             (select rme.soap_inap.no_reg,rme.soap_inap.tgl_masuk,date(rme.soap_inap.tgl_keluar) as tgl_keluar from rme.soap_inap where rme.soap_inap.resume ='1' and deleted is null  group by rme.soap_inap.no_reg,rme.soap_inap.tgl_masuk) ax  
             on ax.no_reg=a.no_reg and ax.tgl_masuk=a.tgl_masuk
             where a.tgl_masuk =ri.tgl_masuk
             group by a.tgl_masuk, a.no_reg
             order by ri.kd_bangsal desc 
        ";
    $riwayat = DB::select($query);
    $rows = (array) null;
    if (!empty($riwayat)) {
        $no = 1;
        foreach ($riwayat as $row) {
            $row = (object) $row;
            $row->no = $no;
            $row->no_reg = $row->no_reg;
            $row->nama = $row->nama;
            $row->tgl_masuk = $row->tgl_masuk;
            if (substr($row->bangsal, 0, 3) == 'ZM2') {
                $row->bangsal = 'ZAM 2';
            } else if (substr($row->bangsal, 0, 3)  == 'PRS') {
                $row->bangsal = 'ROUD';
            } else if (substr($row->bangsal, 0, 3) == 'PRB') {
                $row->bangsal = 'ROUD BY';
            } else if (substr($row->bangsal, 0, 3) == 'HJB') {
                $row->bangsal = 'HJ BY';
            } else if (substr($row->bangsal, 0, 3) == 'HJR') {
                $row->bangsal = 'HJR';
            } else {
                $row->bangsal = $row->bangsal;
            }
            $no++;
            $rows[] = $row;
        }
    }

    $total = count($rows);
    $grand_total = 0;
    if ($total_soap = 0) {
        $total_tjp = 0;
    }
} else {
    // $query = "
    // SELECT a.no_reg, a.nama, a.tgl_masuk, a.jam_masuk,ri.kd_bangsal as bangsal,if(a.no_reg is not null,'V',' ') as awal, 
    // if(b.no_reg is not null,'V',' ') as anak, 
    // if(c.no_reg is not null,'V',' ') as geri,
    // if(d.no_reg is not null,'V',' ') as gine,
    // if(e.no_reg is not null,'V',' ') as imun,
    // if(f.no_reg is not null,'V',' ') as bid,
    // if(g.no_reg is not null,'V',' ') as neo,
    // if(h.no_reg is not null,'V',' ') as rema,
    // if(i.no_reg is not null,'V',' ') as post,
    // if(j.no_reg is not null,'V',' ') as resum,
    // if(k.no_reg is not null,'V',' ') as menul
    // FROM rme.askep_inap_awal a 
    //      LEFT JOIN  rme.askep_inap_tambahan_anak b on b.no_reg=a.no_reg and b.tgl_masuk=a.tgl_masuk
    //      LEFT JOIN  rme.askep_inap_tambahan_geriatri c on c.no_reg=a.no_reg and c.tgl_masuk=a.tgl_masuk 
    //      LEFT JOIN  rme.askep_inap_tambahan_ginekologi d on d.no_reg=a.no_reg and d.tgl_masuk=a.tgl_masuk
    //      LEFT JOIN  rme.askep_inap_tambahan_imunologi_terganggu e on e.no_reg=a.no_reg and e.tgl_masuk=a.tgl_masuk
    //      LEFT JOIN  rme.askep_inap_tambahan_kebidanan f on f.no_reg=a.no_reg and f.tgl_masuk=a.tgl_masuk
    //      LEFT JOIN  rme.askep_inap_tambahan_neonatus g on g.no_reg=a.no_reg and g.tgl_masuk=a.tgl_masuk
    //      LEFT JOIN  rme.askep_inap_tambahan_remaja h on h.no_reg=a.no_reg and h.tgl_masuk=a.tgl_masuk
    //      LEFT JOIN  rme.askep_post_partum i on i.no_reg=a.no_reg and i.tgl_masuk=a.tgl_masuk
    //      LEFT JOIN  rme.askep_inap_summary j on j.no_reg=a.no_reg and j.tgl_masuk=a.tgl_masuk
    //      LEFT JOIN  rme.askep_inap_tambahan_penyakit_menular k on k.no_reg=a.no_reg and k.tgl_masuk=a.tgl_masuk
    //      left join ranap.inap ri  on ri.no_reg = a.no_reg and ri.tgl_masuk= a.tgl_masuk
    //      LEFT JOIN 
    //      (select rme.soap_inap.no_reg,rme.soap_inap.tgl_masuk,date(rme.soap_inap.tgl_keluar) as tgl_keluar from rme.soap_inap where rme.soap_inap.resume ='1' group by rme.soap_inap.no_reg,rme.soap_inap.tgl_masuk) ax  
    //      on ax.no_reg=a.no_reg and ax.tgl_masuk=a.tgl_masuk
    //      where ri.kd_bangsal like '%$uni%' and ri.tgl_masuk= a.tgl_masuk
    //      group by a.tgl_masuk, a.no_reg
    //      order by ri.kd_bangsal desc 
    //     "; 
    $query = "
        SELECT 
        a.no_reg, 
        a.nama, 
        x.umur,
        a.tgl_masuk, 
        a.jam_masuk,
        ri.kd_bangsal as bangsal,
        if(a.no_reg is not null,'V',' ') as awal, 
        if(b.no_reg is not null,'V',' ') as anak, 
        if(c.no_reg is not null,'V',' ') as geri,
        if(d.no_reg is not null,'V',' ') as gine,
        if(e.no_reg is not null,'V',' ') as imun,
        if(f.no_reg is not null,'V',' ') as bid,
        if(g.no_reg is not null,'V',' ') as neo,
        if(h.no_reg is not null,'V',' ') as rema,
        if(i.no_reg is not null,'V',' ') as post,
        if(j.no_reg is not null,'V',' ') as resum,
        if(k.no_reg is not null,'V',' ') as menul,
        if(w.no_reg is not null,'V',' ') as termi,
        if(l.no_reg is not null,'V',' ') as awalmd,
            if(ax.no_reg is not null,'V',' ') as resmd
            FROM rme.askep_inap_awal a 
             LEFT JOIN  
             (select no_reg,tgl_masuk from rme.askep_inap_tambahan_anak where deleted is null) b on b.no_reg=a.no_reg and b.tgl_masuk=a.tgl_masuk
             LEFT JOIN  
             (select no_reg,tgl_masuk from rme.askep_inap_tambahan_geriatri where deleted is null) c on c.no_reg=a.no_reg and c.tgl_masuk=a.tgl_masuk 
             LEFT JOIN 
             (select no_reg,tgl_masuk from rme.askep_inap_tambahan_ginekologi where deleted is null) d on d.no_reg=a.no_reg and d.tgl_masuk=a.tgl_masuk
             LEFT JOIN  
             (select no_reg,tgl_masuk from rme.askep_inap_tambahan_imunologi_terganggu where deleted is null) e on e.no_reg=a.no_reg and e.tgl_masuk=a.tgl_masuk
             LEFT JOIN  
             (select no_reg,tgl_masuk from rme.askep_inap_tambahan_kebidanan where deleted is null) f on f.no_reg=a.no_reg and f.tgl_masuk=a.tgl_masuk
             LEFT JOIN  
              (select no_reg,tgl_masuk from rme.askep_inap_tambahan_neonatus where deleted is null) g on g.no_reg=a.no_reg and g.tgl_masuk=a.tgl_masuk
             LEFT JOIN  
              (select no_reg,tgl_masuk from rme.askep_inap_tambahan_remaja where deleted is null) h on h.no_reg=a.no_reg and h.tgl_masuk=a.tgl_masuk
             LEFT JOIN  
              (select no_reg,tgl_masuk from rme.askep_post_partum where deleted is null) i on i.no_reg=a.no_reg and i.tgl_masuk=a.tgl_masuk
             LEFT JOIN  
              (select no_reg,tgl_masuk from rme.askep_inap_summary where deleted is null) j on j.no_reg=a.no_reg and j.tgl_masuk=a.tgl_masuk
             LEFT JOIN  
              (select no_reg,tgl_masuk from rme.askep_inap_tambahan_penyakit_menular where deleted is null) k on k.no_reg=a.no_reg and k.tgl_masuk=a.tgl_masuk
             left join ranap.inap ri on ri.no_reg = a.no_reg and ri.tgl_masuk= a.tgl_masuk
             left join 
             (select rme.soap_inap.no_reg,rme.soap_inap.tgl_masuk,date(rme.soap_inap.tgl_keluar) as tgl_keluar,round(DATEDIFF(rme.soap_inap.tgl_masuk, rme.soap_inap.tgl_lahir)/365,0) as umur from rme.soap_inap  where rme.soap_inap.resume <> '1' and deleted is null group by rme.soap_inap.no_reg,rme.soap_inap.tgl_masuk) l 
             on l.no_reg=a.no_reg and l.tgl_masuk=a.tgl_masuk
             LEFT JOIN  
             (select no_reg,tgl_masuk from rme.askep_inap_tambahan_terminal where deleted is null ) w on w.no_reg=a.no_reg and w.tgl_masuk=a.tgl_masuk
             left join 
             (select rme.askep_inap_awal.no_reg,rme.askep_inap_awal.tgl_masuk,floor(DATEDIFF(rme.askep_inap_awal.tgl_masuk, rsiklaten.pasien.tgl_lahir)/365) as umur, registered from rme.askep_inap_awal  left join rsiklaten.pasien on rsiklaten.pasien.no_reg=rme.askep_inap_awal.no_reg where  deleted is null group by rme.askep_inap_awal.no_reg,rme.askep_inap_awal.tgl_masuk) x
             on x.no_reg = a.no_reg and x.tgl_masuk =  a.tgl_masuk
             LEFT JOIN 
             (select rme.soap_inap.no_reg,rme.soap_inap.tgl_masuk,date(rme.soap_inap.tgl_keluar) as tgl_keluar from rme.soap_inap where rme.soap_inap.resume ='1' and deleted is null  group by rme.soap_inap.no_reg,rme.soap_inap.tgl_masuk) ax  
             on ax.no_reg=a.no_reg and ax.tgl_masuk=a.tgl_masuk";
    if ($uni == 'JBN') {
        $query .= "     WHERE ri.kd_bangsal LIKE 'JBN%'
                            OR ri.kd_bangsal LIKE 'JBY%'
                    ";
    } else {
        $query .= "     where ri.kd_bangsal like '$uni%' ";
    }
    $query .= " and a.tgl_masuk =ri.tgl_masuk
             group by a.tgl_masuk, a.no_reg
             order by ri.kd_bangsal desc  ";
    $riwayat = DB::select($query);
    $rows = (array) null;
    if (!empty($riwayat)) {
        $no = 1;
        foreach ($riwayat as $row) {
            $row = (object) $row;
            $row->no = $no;
            $row->no_reg = $row->no_reg;
            $row->nama = $row->nama;
            $row->tgl_masuk = $row->tgl_masuk;
            if (substr($row->bangsal, 0, 3) == 'ZM2') {
                $row->bangsal = 'ZAM 2';
            } else if (substr($row->bangsal, 0, 3)  == 'PRS') {
                $row->bangsal = 'ROUD';
            } else if (substr($row->bangsal, 0, 3) == 'PRB') {
                $row->bangsal = 'ROUD BY';
            } else if (substr($row->bangsal, 0, 3) == 'HJB') {
                $row->bangsal = 'HJ BY';
            } else if (substr($row->bangsal, 0, 3) == 'HJR') {
                $row->bangsal = 'HJR';
            } else {
                $row->bangsal = $row->bangsal;
            }
            $no++;
            $rows[] = $row;
        }
    }

    $total = count($rows);
    $grand_total = 0;
    if ($total_soap = 0) {
        $total_tjp = 0;
    }
}

// $total_waiting_rme = $total - $total_tjp - $total_waiting_koder - $total_lengkap;
$data = array(
    "rows" => $rows,
    "total" => $total,
    // "nik" => $nik
    // "grand_total" => $total." KUNJUNGAN PASIEN",
    // "total_admisi" => $total,
    // "total_askep" => $total_askep,
    // "total_lengkap" => $total_lengkap,
    // "total_tjp" => $total_tjp,
    // "total_waiting_koder" => $total_waiting_koder,
    // "total_waiting_rme" => $total_waiting_rme,
);
// pre($data);

return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($data));
