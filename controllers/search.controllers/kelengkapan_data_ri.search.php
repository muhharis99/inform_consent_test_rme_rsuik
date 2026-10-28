<?php 
    // $this->load->model('Kunjung');
    // $kategori = $this->input->get('kategori'); 
    $poli     = $this->input->get('poli');
    $atanggal = date("Y-m-d", strtotime($this->input->get('atanggal')));
    $btanggal = $atanggal;
    $akses    = self::akses_menu();
    $nik      = $akses->nik;
    $induk    = $akses->induk;
// if (ipclient()==IPC) json($induk);
if (in_array($induk, ['RMD', 'PMKP'])) {
    if ($poli == 'SM') { 
            // query mas adi
        // $query = "
        // SELECT a.no_reg, a.nama, t.nmdr,x.umur,a.tgl_masuk, a.jam_masuk,ax.bangsal,if(a.no_reg is not null,date(a.registered),' ') as awal, 
        // if(b.no_reg is not null,'V',' ') as anak, 
        // if(c.no_reg is not null,'V',' ') as geri,
        // if(d.no_reg is not null,'V',' ') as gine,
        // if(e.no_reg is not null,'V',' ') as imun,
        // if(f.no_reg is not null,'V',' ') as bid,
        // if(g.no_reg is not null,'V',' ') as neo,
        // if(h.no_reg is not null,'V',' ') as rema,
        // if(i.no_reg is not null,'V',' ') as post,
        // if(j.no_reg is not null,date(j.registered),' ') as resum,
        // if(k.no_reg is not null,'V',' ') as menul,
        // if(w.no_reg is not null,'V',' ') as termi,
        // if(o.no_reg is not null,'V',' ') as psik,
        // if(l.no_reg is not null,date(l.registered),' ') as awalmd,
        //   if(ax.no_reg is not null,date(ax.registered),' ') as resmd
        // FROM rme.askep_inap_awal a 
        // LEFT JOIN  
        // ( select no_reg,tgl_masuk from rme.askep_inap_tambahan_anak where deleted is null) b on b.no_reg=a.no_reg and b.tgl_masuk=a.tgl_masuk
        //  LEFT JOIN  
        //  (select no_reg,tgl_masuk from rme.askep_inap_tambahan_geriatri where deleted is null) c on c.no_reg=a.no_reg and c.tgl_masuk=a.tgl_masuk 
        //  LEFT JOIN 
        //  (select no_reg,tgl_masuk from rme.askep_inap_tambahan_ginekologi where deleted is null ) d on d.no_reg=a.no_reg and d.tgl_masuk=a.tgl_masuk
        //  LEFT JOIN  
        //  (select no_reg,tgl_masuk from rme.askep_inap_tambahan_imunologi_terganggu where deleted is null) e on e.no_reg=a.no_reg and e.tgl_masuk=a.tgl_masuk
        //  LEFT JOIN  
        //  (select no_reg,tgl_masuk from rme.askep_inap_tambahan_kebidanan where deleted is null ) f on f.no_reg=a.no_reg and f.tgl_masuk=a.tgl_masuk
        //  LEFT JOIN  
        //   (select no_reg,tgl_masuk from rme.askep_inap_tambahan_neonatus where deleted is null ) g on g.no_reg=a.no_reg and g.tgl_masuk=a.tgl_masuk
        //  LEFT JOIN  
        //   (select no_reg,tgl_masuk from rme.askep_inap_tambahan_remaja where deleted is null ) h on h.no_reg=a.no_reg and h.tgl_masuk=a.tgl_masuk
        //  LEFT JOIN  
        //   (select no_reg,tgl_masuk from rme.askep_post_partum where deleted is null ) i on i.no_reg=a.no_reg and i.tgl_masuk=a.tgl_masuk
        //  LEFT JOIN  
        //   (select no_reg,tgl_masuk, registered from rme.askep_inap_summary where deleted is null ) j on j.no_reg=a.no_reg and j.tgl_masuk=a.tgl_masuk
        //  LEFT JOIN  
        //   (select no_reg,tgl_masuk from rme.askep_inap_tambahan_penyakit_menular where deleted is null ) k on k.no_reg=a.no_reg and k.tgl_masuk=a.tgl_masuk
        //   LEFT JOIN  
        //   (select no_reg,tgl_masuk from rme.askep_inap_tambahan_psikiatri where deleted is null ) o on o.no_reg=a.no_reg and o.tgl_masuk=a.tgl_masuk
        //   LEFT JOIN  
        //   (select no_reg,tgl_masuk from rme.askep_inap_tambahan_terminal where deleted is null ) w on w.no_reg=a.no_reg and w.tgl_masuk=a.tgl_masuk
        //   left join 
        //   (select left(left(rsiklaten.dokter.nama,8),8) as nmdr,rme.askep_inap_awal.* from rme.askep_inap_awal left join rsiklaten.dokter on dokter.no_dr=askep_inap_awal.dokter_id ) t 
        //   on t.no_reg=a.no_reg and t.tgl_masuk=a.tgl_masuk
        //   left join 
        //  (select rme.soap_inap.no_reg,rme.soap_inap.tgl_masuk,round(DATEDIFF(rme.soap_inap.tgl_masuk, rme.soap_inap.tgl_lahir)/365,0) as umur,date(rme.soap_inap.tgl_keluar) as tgl_keluar, registered from rme.soap_inap  where rme.soap_inap.resume <> '1' and deleted is null group by rme.soap_inap.no_reg,rme.soap_inap.tgl_masuk) l 
        //  on l.no_reg=a.no_reg and l.tgl_masuk=a.tgl_masuk
        //  left join 
        //  (select rme.askep_inap_awal.no_reg,rme.askep_inap_awal.tgl_masuk,floor(DATEDIFF(rme.askep_inap_awal.tgl_masuk, rsiklaten.pasien.tgl_lahir)/365) as umur, registered from rme.askep_inap_awal  left join rsiklaten.pasien on rsiklaten.pasien.no_reg=rme.askep_inap_awal.no_reg where  deleted is null group by rme.askep_inap_awal.no_reg,rme.askep_inap_awal.tgl_masuk) x
        //  on x.no_reg = a.no_reg and x.tgl_masuk =  a.tgl_masuk 
        //  left join
        //  (select rme.soap_inap.no_reg,rme.soap_inap.tgl_masuk,rme.soap_inap.bangsal_id as bangsal,date(rme.soap_inap.tgl_keluar) as tgl_keluar,registered from rme.soap_inap where rme.soap_inap.resume ='1' group by rme.soap_inap.no_reg,rme.soap_inap.tgl_masuk) ax  
        //      on ax.no_reg=a.no_reg and ax.tgl_masuk=a.tgl_masuk
        //      where ax.tgl_keluar='$atanggal' 
        //      group by a.tgl_masuk, a.no_reg
        //      order by a.poli_id desc 
        // "; 
        
        // query baru by arsyad
        // 21/12/24 syad pakai query ini rm 0535491 tidak muncul,padahal sudah disamakan tgl keluarnya
        $query="
        SELECT a.no_reg, a.nama, 
        t.nmdr,x.umur,a.tgl_masuk, a.jam_masuk,ax.bangsal,if(a.no_reg is not null,date(a.registered),' ') as awal, 
        if(b.no_reg is not null,'V',' ') as anak, 
        if(c.no_reg is not null,'V',' ') as geri,
        if(d.no_reg is not null,'V',' ') as gine,
        if(e.no_reg is not null,'V',' ') as imun,
        if(f.no_reg is not null,'V',' ') as bid,
        if(g.no_reg is not null,'V',' ') as neo,
        if(h.no_reg is not null,'V',' ') as rema,
        if(i.no_reg is not null,'V',' ') as post,
        if(j.no_reg is not null,date(j.registered),' ') as resum,
        if(k.no_reg is not null,'V',' ') as menul,
        if(w.no_reg is not null,'V',' ') as termi,
        if(o.no_reg is not null,'V',' ') as psik,
        if(p.no_reg is not null,'V',' ') as hamb,
        if(q.no_reg is not null and q.tgl_edukasi = '$atanggal','V',' ') as edu,
        if(l.no_reg is not null,date(l.registered),' ') as awalmd,
        if(ax.no_reg is not null,date(ax.registered),' ') as resmd
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
        (select no_reg,tgl_masuk, registered from rme.askep_inap_summary where deleted is null ) j on j.no_reg=a.no_reg and j.tgl_masuk=a.tgl_masuk
        LEFT JOIN  
        (select no_reg,tgl_masuk from rme.askep_inap_tambahan_penyakit_menular where deleted is null ) k on k.no_reg=a.no_reg and k.tgl_masuk=a.tgl_masuk
        LEFT JOIN  
        (select no_reg,tgl_masuk from rme.askep_inap_tambahan_psikiatri where deleted is null ) o on o.no_reg=a.no_reg and o.tgl_masuk=a.tgl_masuk
        LEFT JOIN  
        (select no_reg,tgl_masuk from rme.askep_inap_tambahan_terminal where deleted is null ) w on w.no_reg=a.no_reg and w.tgl_masuk=a.tgl_masuk
        LEFT JOIN  
        (select no_reg,date(tanggal_masuk) as tgl_masuk from rme.edukasi_hambatan where deleted is null ) p on p.no_reg=a.no_reg and p.tgl_masuk=a.tgl_masuk
        LEFT JOIN  
        (select no_reg,date(tanggal_masuk) as tgl_masuk, date(registered) as tgl_edukasi from rme.edukasi_hambatan_list where deleted is null ) q on q.no_reg=a.no_reg and q.tgl_masuk=a.tgl_masuk

        left join 
        (select left(rsiklaten.dokter.nama,8) as nmdr,rme.askep_inap_awal.* from rme.askep_inap_awal left join rsiklaten.dokter on dokter.no_dr=askep_inap_awal.dokter_id ) t 
        on t.no_reg=a.no_reg and t.tgl_masuk=a.tgl_masuk
        left join 
        (select rme.soap_inap.no_reg,rme.soap_inap.tgl_masuk,round(DATEDIFF(rme.soap_inap.tgl_masuk, rme.soap_inap.tgl_lahir)/365,0) as umur,date(rme.soap_inap.tgl_keluar) as tgl_keluar, registered from rme.soap_inap  where rme.soap_inap.resume <> '1' and deleted is null group by rme.soap_inap.no_reg,rme.soap_inap.tgl_masuk) l 
        on l.no_reg=a.no_reg and l.tgl_masuk=a.tgl_masuk
        left join 
        (select rme.askep_inap_awal.no_reg,rme.askep_inap_awal.tgl_masuk,floor(DATEDIFF(rme.askep_inap_awal.tgl_masuk, rsiklaten.pasien.tgl_lahir)/365) as umur, registered from rme.askep_inap_awal  left join rsiklaten.pasien on rsiklaten.pasien.no_reg=rme.askep_inap_awal.no_reg where  deleted is null group by rme.askep_inap_awal.no_reg,rme.askep_inap_awal.tgl_masuk) x
        on x.no_reg = a.no_reg and x.tgl_masuk =  a.tgl_masuk 
            JOIN(
                SELECT max(rme.soap_inap.id) as idMax,
                rme.soap_inap.no_reg,
                rme.soap_inap.tgl_masuk,
                date(rme.soap_inap.tgl_keluar) as tgl_keluar
                FROM rme.soap_inap
                WHERE rme.soap_inap.resume ='1' and rme.soap_inap.deleted is null and rme.soap_inap.no_reg!=''
                AND DATE(rme.soap_inap.tgl_keluar)='$atanggal' 
                GROUP BY rme.soap_inap.no_reg,
                rme.soap_inap.tgl_masuk
            ) as soap_inap_terbaru
            ON soap_inap_terbaru.no_reg=a.no_reg
            and soap_inap_terbaru.tgl_masuk=a.tgl_masuk
            JOIN 
            (
                select rme.soap_inap.id,
                rme.soap_inap.no_reg,
                rme.soap_inap.tgl_masuk,
                rme.soap_inap.bangsal_id as bangsal,
                date(rme.soap_inap.tgl_keluar) as tgl_keluar,
                registered 
                from rme.soap_inap 
                where rme.soap_inap.resume ='1'AND DATE(rme.soap_inap.tgl_keluar)='$atanggal' and rme.soap_inap.no_reg!=''
            ) ax 
            ON soap_inap_terbaru.idMax=ax.id
        group by a.tgl_masuk, a.no_reg
        order by a.poli_id desc
        ";
    } else if ($poli == 'HJ'){
        $query = "
        SELECT a.no_reg, a.nama,x.umur, t.nmdr,a.tgl_masuk, a.jam_masuk,a.poli_id as bangsal,if(a.no_reg is not null,date(a.registered),' ') as awal, 
        if(b.no_reg is not null,'V',' ') as anak, 
        if(c.no_reg is not null,'V',' ') as geri,
        if(d.no_reg is not null,'V',' ') as gine,
        if(e.no_reg is not null,'V',' ') as imun,
        if(f.no_reg is not null,'V',' ') as bid,
        if(g.no_reg is not null,'V',' ') as neo,
        if(h.no_reg is not null,'V',' ') as rema,
        if(i.no_reg is not null,'V',' ') as post,
        if(j.no_reg is not null,date(j.registered),' ') as resum,
        if(k.no_reg is not null,'V',' ') as menul,
        if(w.no_reg is not null,'V',' ') as termi,
        if(w.no_reg is not null,'V',' ') as psik,
        if(p.no_reg is not null,'V',' ') as hamb,
        if(q.no_reg is not null and q.tgl_edukasi = '$atanggal','V',' ') as edu,
        if(l.no_reg is not null,date(l.registered),' ') as awalmd,
        if(ax.no_reg is not null,date(ax.registered),' ') as resmd
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
        (select no_reg,tgl_masuk, registered from rme.askep_inap_summary where deleted is null ) j on j.no_reg=a.no_reg and j.tgl_masuk=a.tgl_masuk
        LEFT JOIN  
        (select no_reg,tgl_masuk from rme.askep_inap_tambahan_penyakit_menular where deleted is null ) k on k.no_reg=a.no_reg and k.tgl_masuk=a.tgl_masuk
        LEFT JOIN  
        (select no_reg,tgl_masuk from rme.askep_inap_tambahan_terminal where deleted is null ) w on w.no_reg=a.no_reg and w.tgl_masuk=a.tgl_masuk
        LEFT JOIN  
        (select no_reg,date(tanggal_masuk) as tgl_masuk from rme.edukasi_hambatan where deleted is null ) p on p.no_reg=a.no_reg and p.tgl_masuk=a.tgl_masuk
        LEFT JOIN  
        (select no_reg,date(tanggal_masuk) as tgl_masuk, date(registered) as tgl_edukasi from rme.edukasi_hambatan_list where deleted is null ) q on q.no_reg=a.no_reg and q.tgl_masuk=a.tgl_masuk
        left join 
        (select left(rsiklaten.dokter.nama,8) as nmdr,rme.askep_inap_awal.* from rme.askep_inap_awal left join rsiklaten.dokter on dokter.no_dr=askep_inap_awal.dokter_id ) t 
        on t.no_reg=a.no_reg and t.tgl_masuk=a.tgl_masuk
        LEFT JOIN  
        (select no_reg,tgl_masuk from rme.askep_inap_tambahan_psikiatri where deleted is null ) o on o.no_reg=a.no_reg and o.tgl_masuk=a.tgl_masuk
        left join 
        (select rme.askep_inap_awal.no_reg,rme.askep_inap_awal.tgl_masuk,round(DATEDIFF(rme.askep_inap_awal.tgl_masuk, rsiklaten.pasien.tgl_lahir)/365,0) as umur, registered from rme.askep_inap_awal  left join rsiklaten.pasien on rsiklaten.pasien.no_reg=rme.askep_inap_awal.no_reg where  deleted is null group by rme.askep_inap_awal.no_reg,rme.askep_inap_awal.tgl_masuk) x
        on x.no_reg = a.no_reg and x.tgl_masuk =  a.tgl_masuk
        left join 
        (select rme.soap_inap.no_reg,rme.soap_inap.tgl_masuk,floor(DATEDIFF(rme.soap_inap.tgl_masuk, rme.soap_inap.tgl_lahir)/365) as umur,date(rme.soap_inap.tgl_keluar) as tgl_keluar, registered from rme.soap_inap  where rme.soap_inap.resume <> '1' and deleted is null group by rme.soap_inap.no_reg,rme.soap_inap.tgl_masuk) l 
        on l.no_reg=a.no_reg and l.tgl_masuk=a.tgl_masuk  
            LEFT JOIN 
            (select rme.soap_inap.no_reg,rme.soap_inap.tgl_masuk,date(rme.soap_inap.tgl_keluar) as tgl_keluar, registered from rme.soap_inap where rme.soap_inap.resume ='1' group by rme.soap_inap.no_reg,rme.soap_inap.tgl_masuk) ax  
            on ax.no_reg=a.no_reg and ax.tgl_masuk=a.tgl_masuk
            where ax.tgl_keluar='$atanggal' and a.poli_id in ('HJR','HJB','IMC')
            group by a.tgl_masuk, a.no_reg
            "; 
    } else {
            $query = "
            SELECT a.no_reg, a.nama, t.nmdr,l.umur, a.tgl_masuk, a.jam_masuk,a.poli_id as bangsal,if(a.no_reg is not null,date(a.registered),' ') as awal, 
            if(b.no_reg is not null,'V',' ') as anak, 
            if(c.no_reg is not null,'V',' ') as geri,
            if(d.no_reg is not null,'V',' ') as gine,
            if(e.no_reg is not null,'V',' ') as imun,
            if(f.no_reg is not null,'V',' ') as bid,
            if(g.no_reg is not null,'V',' ') as neo,
            if(h.no_reg is not null,'V',' ') as rema,
            if(i.no_reg is not null,'V',' ') as post,
            if(j.no_reg is not null,date(j.registered),' ') as resum,
            if(k.no_reg is not null,'V',' ') as menul,
            if(w.no_reg is not null,'V',' ') as termi,
            if(o.no_reg is not null,'V',' ') as psik,
            if(p.no_reg is not null,'V',' ') as hamb,
            if(q.no_reg is not null and q.tgl_edukasi = '$atanggal','V',' ') as edu,
            if(l.no_reg is not null,date(l.registered),' ') as awalmd,
            if(ax.no_reg is not null,date(ax.registered),' ') as resmd
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
            (select no_reg,tgl_masuk,registered from rme.askep_inap_summary where deleted is null ) j on j.no_reg=a.no_reg and j.tgl_masuk=a.tgl_masuk
            LEFT JOIN  
            (select no_reg,tgl_masuk from rme.askep_inap_tambahan_penyakit_menular where deleted is null ) k on k.no_reg=a.no_reg and k.tgl_masuk=a.tgl_masuk
            LEFT JOIN  
            (select no_reg,date(tanggal_masuk) as tgl_masuk from rme.edukasi_hambatan where deleted is null ) p on p.no_reg=a.no_reg and p.tgl_masuk=a.tgl_masuk
            LEFT JOIN  
            (select no_reg,date(tanggal_masuk) as tgl_masuk, date(registered) as tgl_edukasi from rme.edukasi_hambatan_list where deleted is null ) q on q.no_reg=a.no_reg and q.tgl_masuk=a.tgl_masuk
            left join 
            (select left(rsiklaten.dokter.nama,8) as nmdr,rme.askep_inap_awal.* from rme.askep_inap_awal left join rsiklaten.dokter on dokter.no_dr=askep_inap_awal.dokter_id ) t 
            on t.no_reg=a.no_reg and t.tgl_masuk=a.tgl_masuk
            LEFT JOIN  
            (select no_reg,tgl_masuk from rme.askep_inap_tambahan_terminal where deleted is null ) w on w.no_reg=a.no_reg and w.tgl_masuk=a.tgl_masuk
            LEFT JOIN  
            (select no_reg,tgl_masuk from rme.askep_inap_tambahan_psikiatri where deleted is null ) o on o.no_reg=a.no_reg and o.tgl_masuk=a.tgl_masuk
            left join
            (select rme.askep_inap_awal.no_reg,rme.askep_inap_awal.tgl_masuk,floor(DATEDIFF(rme.askep_inap_awal.tgl_masuk, rsiklaten.pasien.tgl_lahir)/365) as umur, registered from rme.askep_inap_awal  left join rsiklaten.pasien on rsiklaten.pasien.no_reg=rme.askep_inap_awal.no_reg where  deleted is null group by rme.askep_inap_awal.no_reg,rme.askep_inap_awal.tgl_masuk) x
            on x.no_reg = a.no_reg and x.tgl_masuk =  a.tgl_masuk
            left join 
            (select rme.soap_inap.no_reg,rme.soap_inap.tgl_masuk,round(DATEDIFF(rme.soap_inap.tgl_masuk, rme.soap_inap.tgl_lahir)/365,0) as umur,date(rme.soap_inap.tgl_keluar) as tgl_keluar, registered from rme.soap_inap  where rme.soap_inap.resume <> '1' and deleted is null group by rme.soap_inap.no_reg,rme.soap_inap.tgl_masuk) l 
            on l.no_reg=a.no_reg and l.tgl_masuk=a.tgl_masuk
            LEFT JOIN 
                (select rme.soap_inap.no_reg,rme.soap_inap.tgl_masuk,date(rme.soap_inap.tgl_keluar) as tgl_keluar, registered from rme.soap_inap where rme.soap_inap.resume ='1' group by rme.soap_inap.no_reg,rme.soap_inap.tgl_masuk) ax  
                on ax.no_reg=a.no_reg and ax.tgl_masuk=a.tgl_masuk
                where ax.tgl_keluar='$atanggal' and a.poli_id = '$poli'
                group by a.tgl_masuk, a.no_reg
                "; 
        }
            //  pre($query);
            $riwayat = DB::connection('slave')->select($query);
            // $riwayat = DB::select($query);
            // echo"<pre>";print_r($riwayat);die();
            $rows = (array) null; 
            if (!empty($riwayat)) {
                $no = 1; 
                foreach ($riwayat as $row) {
                    $row = (object) $row;
                    $row->no = $no; 
                    $row->no_reg = $row->no_reg  ;
                    $row->nama = $row->nama ;
                    $row->tgl_masuk = $row->tgl_masuk;
                    if($row->bangsal == 'ZM2'){
                        $row->bangsal = 'ZAM 2' ;
                    }
                    else if($row->bangsal == 'PRS'){
                        $row->bangsal = 'ROUD' ;
                    }
                    else if($row->bangsal == 'PRB'){
                        $row->bangsal = 'ROUD BY' ;
                    }
                    else {
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
            

}else if ($nik == '100493'){
    if ($poli == 'SM'){ 
        // $query = "
        // SELECT a.no_reg, a.nama, t.nmdr,x.umur,a.tgl_masuk, a.jam_masuk,ax.bangsal,if(a.no_reg is not null,date(a.registered),' ') as awal, 
        // if(b.no_reg is not null,'V',' ') as anak, 
        // if(c.no_reg is not null,'V',' ') as geri,
        // if(d.no_reg is not null,'V',' ') as gine,
        // if(e.no_reg is not null,'V',' ') as imun,
        // if(f.no_reg is not null,'V',' ') as bid,
        // if(g.no_reg is not null,'V',' ') as neo,
        // if(h.no_reg is not null,'V',' ') as rema,
        // if(i.no_reg is not null,'V',' ') as post,
        // if(j.no_reg is not null,date(j.registered),' ') as resum,
        // if(k.no_reg is not null,'V',' ') as menul,
        // if(w.no_reg is not null,'V',' ') as termi,
        // if(o.no_reg is not null,'V',' ') as psik,
        // if(l.no_reg is not null,date(l.registered),' ') as awalmd,
        //   if(ax.no_reg is not null,date(ax.registered),' ') as resmd
        // FROM rme.askep_inap_awal a 
        // LEFT JOIN  
        // ( select no_reg,tgl_masuk from rme.askep_inap_tambahan_anak where deleted is null) b on b.no_reg=a.no_reg and b.tgl_masuk=a.tgl_masuk
        //  LEFT JOIN  
        //  (select no_reg,tgl_masuk from rme.askep_inap_tambahan_geriatri where deleted is null) c on c.no_reg=a.no_reg and c.tgl_masuk=a.tgl_masuk 
        //  LEFT JOIN 
        //  (select no_reg,tgl_masuk from rme.askep_inap_tambahan_ginekologi where deleted is null ) d on d.no_reg=a.no_reg and d.tgl_masuk=a.tgl_masuk
        //  LEFT JOIN  
        //  (select no_reg,tgl_masuk from rme.askep_inap_tambahan_imunologi_terganggu where deleted is null) e on e.no_reg=a.no_reg and e.tgl_masuk=a.tgl_masuk
        //  LEFT JOIN  
        //  (select no_reg,tgl_masuk from rme.askep_inap_tambahan_kebidanan where deleted is null ) f on f.no_reg=a.no_reg and f.tgl_masuk=a.tgl_masuk
        //  LEFT JOIN  
        //   (select no_reg,tgl_masuk from rme.askep_inap_tambahan_neonatus where deleted is null ) g on g.no_reg=a.no_reg and g.tgl_masuk=a.tgl_masuk
        //  LEFT JOIN  
        //   (select no_reg,tgl_masuk from rme.askep_inap_tambahan_remaja where deleted is null ) h on h.no_reg=a.no_reg and h.tgl_masuk=a.tgl_masuk
        //  LEFT JOIN  
        //   (select no_reg,tgl_masuk from rme.askep_post_partum where deleted is null ) i on i.no_reg=a.no_reg and i.tgl_masuk=a.tgl_masuk
        //  LEFT JOIN  
        //   (select no_reg,tgl_masuk, registered from rme.askep_inap_summary where deleted is null ) j on j.no_reg=a.no_reg and j.tgl_masuk=a.tgl_masuk
        //  LEFT JOIN  
        //   (select no_reg,tgl_masuk from rme.askep_inap_tambahan_penyakit_menular where deleted is null ) k on k.no_reg=a.no_reg and k.tgl_masuk=a.tgl_masuk
        //   LEFT JOIN  
        //   (select no_reg,tgl_masuk from rme.askep_inap_tambahan_psikiatri where deleted is null ) o on o.no_reg=a.no_reg and o.tgl_masuk=a.tgl_masuk
        //   LEFT JOIN  
        //   (select no_reg,tgl_masuk from rme.askep_inap_tambahan_terminal where deleted is null ) w on w.no_reg=a.no_reg and w.tgl_masuk=a.tgl_masuk
        //   left join 
        //   (select left(left(rsiklaten.dokter.nama,8),8) as nmdr,rme.askep_inap_awal.* from rme.askep_inap_awal left join rsiklaten.dokter on dokter.no_dr=askep_inap_awal.dokter_id ) t 
        //   on t.no_reg=a.no_reg and t.tgl_masuk=a.tgl_masuk
        //   left join 
        //  (select rme.soap_inap.no_reg,rme.soap_inap.tgl_masuk,round(DATEDIFF(rme.soap_inap.tgl_masuk, rme.soap_inap.tgl_lahir)/365,0) as umur,date(rme.soap_inap.tgl_keluar) as tgl_keluar, registered from rme.soap_inap  where rme.soap_inap.resume <> '1' and deleted is null group by rme.soap_inap.no_reg,rme.soap_inap.tgl_masuk) l 
        //  on l.no_reg=a.no_reg and l.tgl_masuk=a.tgl_masuk
        //  left join 
        //  (select rme.askep_inap_awal.no_reg,rme.askep_inap_awal.tgl_masuk,floor(DATEDIFF(rme.askep_inap_awal.tgl_masuk, rsiklaten.pasien.tgl_lahir)/365) as umur, registered from rme.askep_inap_awal  left join rsiklaten.pasien on rsiklaten.pasien.no_reg=rme.askep_inap_awal.no_reg where  deleted is null group by rme.askep_inap_awal.no_reg,rme.askep_inap_awal.tgl_masuk) x
        //  on x.no_reg = a.no_reg and x.tgl_masuk =  a.tgl_masuk 
        //  left join
        //  (select rme.soap_inap.no_reg,rme.soap_inap.tgl_masuk,rme.soap_inap.bangsal_id as bangsal,date(rme.soap_inap.tgl_keluar) as tgl_keluar,registered from rme.soap_inap where rme.soap_inap.resume ='1' group by rme.soap_inap.no_reg,rme.soap_inap.tgl_masuk) ax  
        //      on ax.no_reg=a.no_reg and ax.tgl_masuk=a.tgl_masuk
        //      where ax.tgl_keluar='$atanggal' 
        //      group by a.tgl_masuk, a.no_reg
        //      order by a.poli_id desc 
        // "; 
        $query="
        SELECT a.no_reg, a.nama,
        t.nmdr,x.umur,
        a.tgl_masuk, a.jam_masuk,ax.bangsal_id as bangsal,if(a.no_reg is not null,date(a.registered),' ') as awal, 
        if(b.no_reg is not null,'V',' ') as anak, 
        if(c.no_reg is not null,'V',' ') as geri,
        if(d.no_reg is not null,'V',' ') as gine,
        if(e.no_reg is not null,'V',' ') as imun,
        if(f.no_reg is not null,'V',' ') as bid,
        if(g.no_reg is not null,'V',' ') as neo,
        if(h.no_reg is not null,'V',' ') as rema,
        if(i.no_reg is not null,'V',' ') as post,
        if(j.no_reg is not null,date(j.registered),' ') as resum,
        if(k.no_reg is not null,'V',' ') as menul,
        if(w.no_reg is not null,'V',' ') as termi,
        if(o.no_reg is not null,'V',' ') as psik,
        if(l.no_reg is not null,date(l.registered),' ') as awalmd,
        if(ax.no_reg is not null,date(ax.registered),' ') as resmd
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
        (select no_reg,tgl_masuk, registered from rme.askep_inap_summary where deleted is null ) j on j.no_reg=a.no_reg and j.tgl_masuk=a.tgl_masuk
        LEFT JOIN  
        (select no_reg,tgl_masuk from rme.askep_inap_tambahan_penyakit_menular where deleted is null ) k on k.no_reg=a.no_reg and k.tgl_masuk=a.tgl_masuk
        LEFT JOIN  
        (select no_reg,tgl_masuk from rme.askep_inap_tambahan_psikiatri where deleted is null ) o on o.no_reg=a.no_reg and o.tgl_masuk=a.tgl_masuk
        LEFT JOIN  
        (select no_reg,tgl_masuk from rme.askep_inap_tambahan_terminal where deleted is null ) w on w.no_reg=a.no_reg and w.tgl_masuk=a.tgl_masuk
        left join 
        (select left(left(rsiklaten.dokter.nama,8),8) as nmdr,rme.askep_inap_awal.* from rme.askep_inap_awal left join rsiklaten.dokter on dokter.no_dr=askep_inap_awal.dokter_id ) t 
        on t.no_reg=a.no_reg and t.tgl_masuk=a.tgl_masuk
        left join 
        (select rme.soap_inap.no_reg,rme.soap_inap.tgl_masuk,round(DATEDIFF(rme.soap_inap.tgl_masuk, rme.soap_inap.tgl_lahir)/365,0) as umur,date(rme.soap_inap.tgl_keluar) as tgl_keluar, registered from rme.soap_inap  where rme.soap_inap.resume <> '1' and deleted is null group by rme.soap_inap.no_reg,rme.soap_inap.tgl_masuk) l 
        on l.no_reg=a.no_reg and l.tgl_masuk=a.tgl_masuk
        left join 
        (select rme.askep_inap_awal.no_reg,rme.askep_inap_awal.tgl_masuk,floor(DATEDIFF(rme.askep_inap_awal.tgl_masuk, rsiklaten.pasien.tgl_lahir)/365) as umur, registered from rme.askep_inap_awal  left join rsiklaten.pasien on rsiklaten.pasien.no_reg=rme.askep_inap_awal.no_reg where  deleted is null group by rme.askep_inap_awal.no_reg,rme.askep_inap_awal.tgl_masuk) x
        on x.no_reg = a.no_reg and x.tgl_masuk =  a.tgl_masuk 
        LEFT JOIN(
            select max(rme.soap_inap.id) as idMax,
            rme.soap_inap.no_reg,
            rme.soap_inap.tgl_masuk
            FROM rme.soap_inap
            WHERE DATE(rme.soap_inap.tgl_keluar)='".$atanggal."'
            group by no_reg,tgl_masuk
        ) as soap_terbaru
        ON soap_terbaru.no_reg=a.no_reg
        AND soap_terbaru.tgl_masuk=a.tgl_masuk
        JOIN rme.soap_inap as ax
        ON ax.id=soap_terbaru.idMax
        ";
        // if (ipclient()=='172.16.18.192') json(
        //     $query
        // );
    }else if ($poli == 'HJ'){
        // $query = "
        // SELECT a.no_reg, a.nama,x.umur, t.nmdr,a.tgl_masuk, a.jam_masuk,a.poli_id as bangsal,if(a.no_reg is not null,date(a.registered),' ') as awal, 
        // if(b.no_reg is not null,'V',' ') as anak, 
        // if(c.no_reg is not null,'V',' ') as geri,
        // if(d.no_reg is not null,'V',' ') as gine,
        // if(e.no_reg is not null,'V',' ') as imun,
        // if(f.no_reg is not null,'V',' ') as bid,
        // if(g.no_reg is not null,'V',' ') as neo,
        // if(h.no_reg is not null,'V',' ') as rema,
        // if(i.no_reg is not null,'V',' ') as post,
        // if(j.no_reg is not null,date(j.registered),' ') as resum,
        // if(k.no_reg is not null,'V',' ') as menul,
        // if(w.no_reg is not null,'V',' ') as termi,
        // if(w.no_reg is not null,'V',' ') as psik,
        // if(l.no_reg is not null,date(l.registered),' ') as awalmd,
        // if(ax.no_reg is not null,date(ax.registered),' ') as resmd
        // FROM rme.askep_inap_awal a 
        // LEFT JOIN  
        // ( select no_reg,tgl_masuk from rme.askep_inap_tambahan_anak where deleted is null) b on b.no_reg=a.no_reg and b.tgl_masuk=a.tgl_masuk
        //  LEFT JOIN  
        //  (select no_reg,tgl_masuk from rme.askep_inap_tambahan_geriatri where deleted is null) c on c.no_reg=a.no_reg and c.tgl_masuk=a.tgl_masuk 
        //  LEFT JOIN 
        //  (select no_reg,tgl_masuk from rme.askep_inap_tambahan_ginekologi where deleted is null ) d on d.no_reg=a.no_reg and d.tgl_masuk=a.tgl_masuk
        //  LEFT JOIN  
        //  (select no_reg,tgl_masuk from rme.askep_inap_tambahan_imunologi_terganggu where deleted is null) e on e.no_reg=a.no_reg and e.tgl_masuk=a.tgl_masuk
        //  LEFT JOIN  
        //  (select no_reg,tgl_masuk from rme.askep_inap_tambahan_kebidanan where deleted is null ) f on f.no_reg=a.no_reg and f.tgl_masuk=a.tgl_masuk
        //  LEFT JOIN  
        //   (select no_reg,tgl_masuk from rme.askep_inap_tambahan_neonatus where deleted is null ) g on g.no_reg=a.no_reg and g.tgl_masuk=a.tgl_masuk
        //  LEFT JOIN  
        //   (select no_reg,tgl_masuk from rme.askep_inap_tambahan_remaja where deleted is null ) h on h.no_reg=a.no_reg and h.tgl_masuk=a.tgl_masuk
        //  LEFT JOIN  
        //   (select no_reg,tgl_masuk from rme.askep_post_partum where deleted is null ) i on i.no_reg=a.no_reg and i.tgl_masuk=a.tgl_masuk
        //  LEFT JOIN  
        //   (select no_reg,tgl_masuk, registered from rme.askep_inap_summary where deleted is null ) j on j.no_reg=a.no_reg and j.tgl_masuk=a.tgl_masuk
        //  LEFT JOIN  
        //   (select no_reg,tgl_masuk from rme.askep_inap_tambahan_penyakit_menular where deleted is null ) k on k.no_reg=a.no_reg and k.tgl_masuk=a.tgl_masuk
        //   LEFT JOIN  
        //   (select no_reg,tgl_masuk from rme.askep_inap_tambahan_terminal where deleted is null ) w on w.no_reg=a.no_reg and w.tgl_masuk=a.tgl_masuk
        //   left join 
        //   (select left(rsiklaten.dokter.nama,8) as nmdr,rme.askep_inap_awal.* from rme.askep_inap_awal left join rsiklaten.dokter on dokter.no_dr=askep_inap_awal.dokter_id ) t 
        //   on t.no_reg=a.no_reg and t.tgl_masuk=a.tgl_masuk
        //   LEFT JOIN  
        //   (select no_reg,tgl_masuk from rme.askep_inap_tambahan_psikiatri where deleted is null ) o on o.no_reg=a.no_reg and o.tgl_masuk=a.tgl_masuk
        //   left join 
        //   (select rme.askep_inap_awal.no_reg,rme.askep_inap_awal.tgl_masuk,round(DATEDIFF(rme.askep_inap_awal.tgl_masuk, rsiklaten.pasien.tgl_lahir)/365,0) as umur, registered from rme.askep_inap_awal  left join rsiklaten.pasien on rsiklaten.pasien.no_reg=rme.askep_inap_awal.no_reg where  deleted is null group by rme.askep_inap_awal.no_reg,rme.askep_inap_awal.tgl_masuk) x
        //   on x.no_reg = a.no_reg and x.tgl_masuk =  a.tgl_masuk
        //   left join 
        //  (select rme.soap_inap.no_reg,rme.soap_inap.tgl_masuk,floor(DATEDIFF(rme.soap_inap.tgl_masuk, rme.soap_inap.tgl_lahir)/365) as umur,date(rme.soap_inap.tgl_keluar) as tgl_keluar, registered from rme.soap_inap  where rme.soap_inap.resume <> '1' and deleted is null group by rme.soap_inap.no_reg,rme.soap_inap.tgl_masuk) l 
        //  on l.no_reg=a.no_reg and l.tgl_masuk=a.tgl_masuk  
        //        LEFT JOIN 
        //      (select rme.soap_inap.no_reg,rme.soap_inap.tgl_masuk,date(rme.soap_inap.tgl_keluar) as tgl_keluar, registered from rme.soap_inap where rme.soap_inap.resume ='1' group by rme.soap_inap.no_reg,rme.soap_inap.tgl_masuk) ax  
        //      on ax.no_reg=a.no_reg and ax.tgl_masuk=a.tgl_masuk
        //      where ax.tgl_keluar='$atanggal' and a.poli_id in ('HJR','HJB','IMC')
        //      group by a.tgl_masuk, a.no_reg
        //     "; 

        $query="
        SELECT a.no_reg, a.nama,
        t.nmdr,x.umur,
        a.tgl_masuk, a.jam_masuk,ax.bangsal_id as bangsal,if(a.no_reg is not null,date(a.registered),' ') as awal, 
        if(b.no_reg is not null,'V',' ') as anak, 
        if(c.no_reg is not null,'V',' ') as geri,
        if(d.no_reg is not null,'V',' ') as gine,
        if(e.no_reg is not null,'V',' ') as imun,
        if(f.no_reg is not null,'V',' ') as bid,
        if(g.no_reg is not null,'V',' ') as neo,
        if(h.no_reg is not null,'V',' ') as rema,
        if(i.no_reg is not null,'V',' ') as post,
        if(j.no_reg is not null,date(j.registered),' ') as resum,
        if(k.no_reg is not null,'V',' ') as menul,
        if(w.no_reg is not null,'V',' ') as termi,
        if(o.no_reg is not null,'V',' ') as psik,
        if(l.no_reg is not null,date(l.registered),' ') as awalmd,
        if(ax.no_reg is not null,date(ax.registered),' ') as resmd
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
        (select no_reg,tgl_masuk, registered from rme.askep_inap_summary where deleted is null ) j on j.no_reg=a.no_reg and j.tgl_masuk=a.tgl_masuk
        LEFT JOIN  
        (select no_reg,tgl_masuk from rme.askep_inap_tambahan_penyakit_menular where deleted is null ) k on k.no_reg=a.no_reg and k.tgl_masuk=a.tgl_masuk
        LEFT JOIN  
        (select no_reg,tgl_masuk from rme.askep_inap_tambahan_psikiatri where deleted is null ) o on o.no_reg=a.no_reg and o.tgl_masuk=a.tgl_masuk
        LEFT JOIN  
        (select no_reg,tgl_masuk from rme.askep_inap_tambahan_terminal where deleted is null ) w on w.no_reg=a.no_reg and w.tgl_masuk=a.tgl_masuk
        left join 
        (select left(left(rsiklaten.dokter.nama,8),8) as nmdr,rme.askep_inap_awal.* from rme.askep_inap_awal left join rsiklaten.dokter on dokter.no_dr=askep_inap_awal.dokter_id ) t 
        on t.no_reg=a.no_reg and t.tgl_masuk=a.tgl_masuk
        left join 
        (select rme.soap_inap.no_reg,rme.soap_inap.tgl_masuk,round(DATEDIFF(rme.soap_inap.tgl_masuk, rme.soap_inap.tgl_lahir)/365,0) as umur,date(rme.soap_inap.tgl_keluar) as tgl_keluar, registered from rme.soap_inap  where rme.soap_inap.resume <> '1' and deleted is null group by rme.soap_inap.no_reg,rme.soap_inap.tgl_masuk) l 
        on l.no_reg=a.no_reg and l.tgl_masuk=a.tgl_masuk
        left join 
        (select rme.askep_inap_awal.no_reg,rme.askep_inap_awal.tgl_masuk,floor(DATEDIFF(rme.askep_inap_awal.tgl_masuk, rsiklaten.pasien.tgl_lahir)/365) as umur, registered from rme.askep_inap_awal  left join rsiklaten.pasien on rsiklaten.pasien.no_reg=rme.askep_inap_awal.no_reg where  deleted is null group by rme.askep_inap_awal.no_reg,rme.askep_inap_awal.tgl_masuk) x
        on x.no_reg = a.no_reg and x.tgl_masuk =  a.tgl_masuk 
        LEFT JOIN(
            select max(rme.soap_inap.id) as idMax,
            rme.soap_inap.no_reg,
            rme.soap_inap.tgl_masuk
            FROM rme.soap_inap
            WHERE rme.soap_inap.tgl_keluar='".$atanggal."'
            and a.poli_id in ('HJR','HJB','IMC')
            group by no_reg,tgl_masuk
        ) as soap_terbaru
        ON soap_terbaru.no_reg=a.no_reg
        AND soap_terbaru.tgl_masuk=a.tgl_masuk
        JOIN rme.soap_inap as ax
        ON ax.id=soap_terbaru.idMax
        ";
    }else {
        $query = "
        SELECT a.no_reg, a.nama, t.nmdr,l.umur, a.tgl_masuk, a.jam_masuk,a.poli_id as bangsal,if(a.no_reg is not null,date(a.registered),' ') as awal, 
        if(b.no_reg is not null,'V',' ') as anak, 
        if(c.no_reg is not null,'V',' ') as geri,
        if(d.no_reg is not null,'V',' ') as gine,
        if(e.no_reg is not null,'V',' ') as imun,
        if(f.no_reg is not null,'V',' ') as bid,
        if(g.no_reg is not null,'V',' ') as neo,
        if(h.no_reg is not null,'V',' ') as rema,
        if(i.no_reg is not null,'V',' ') as post,
        if(j.no_reg is not null,date(j.registered),' ') as resum,
        if(k.no_reg is not null,'V',' ') as menul,
        if(w.no_reg is not null,'V',' ') as termi,
        if(o.no_reg is not null,'V',' ') as psik,
        if(l.no_reg is not null,date(l.registered),' ') as awalmd,
        if(ax.no_reg is not null,date(ax.registered),' ') as resmd
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
          (select no_reg,tgl_masuk,registered from rme.askep_inap_summary where deleted is null ) j on j.no_reg=a.no_reg and j.tgl_masuk=a.tgl_masuk
         LEFT JOIN  
          (select no_reg,tgl_masuk from rme.askep_inap_tambahan_penyakit_menular where deleted is null ) k on k.no_reg=a.no_reg and k.tgl_masuk=a.tgl_masuk
          left join 
          (select left(rsiklaten.dokter.nama,8) as nmdr,rme.askep_inap_awal.* from rme.askep_inap_awal left join rsiklaten.dokter on dokter.no_dr=askep_inap_awal.dokter_id ) t 
          on t.no_reg=a.no_reg and t.tgl_masuk=a.tgl_masuk
          LEFT JOIN  
          (select no_reg,tgl_masuk from rme.askep_inap_tambahan_terminal where deleted is null ) w on w.no_reg=a.no_reg and w.tgl_masuk=a.tgl_masuk
          LEFT JOIN  
          (select no_reg,tgl_masuk from rme.askep_inap_tambahan_psikiatri where deleted is null ) o on o.no_reg=a.no_reg and o.tgl_masuk=a.tgl_masuk
         left join
          (select rme.askep_inap_awal.no_reg,rme.askep_inap_awal.tgl_masuk,floor(DATEDIFF(rme.askep_inap_awal.tgl_masuk, rsiklaten.pasien.tgl_lahir)/365) as umur, registered from rme.askep_inap_awal  left join rsiklaten.pasien on rsiklaten.pasien.no_reg=rme.askep_inap_awal.no_reg where  deleted is null group by rme.askep_inap_awal.no_reg,rme.askep_inap_awal.tgl_masuk) x
          on x.no_reg = a.no_reg and x.tgl_masuk =  a.tgl_masuk
          left join 
          (select rme.soap_inap.no_reg,rme.soap_inap.tgl_masuk,round(DATEDIFF(rme.soap_inap.tgl_masuk, rme.soap_inap.tgl_lahir)/365,0) as umur,date(rme.soap_inap.tgl_keluar) as tgl_keluar, registered from rme.soap_inap  where rme.soap_inap.resume <> '1' and deleted is null group by rme.soap_inap.no_reg,rme.soap_inap.tgl_masuk) l 
          on l.no_reg=a.no_reg and l.tgl_masuk=a.tgl_masuk
          LEFT JOIN 
             (select rme.soap_inap.no_reg,rme.soap_inap.tgl_masuk,date(rme.soap_inap.tgl_keluar) as tgl_keluar, registered from rme.soap_inap where rme.soap_inap.resume ='1' group by rme.soap_inap.no_reg,rme.soap_inap.tgl_masuk) ax  
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
            $row->no_reg = $row->no_reg  ;
            $row->nama = $row->nama ;
            $row->tgl_masuk = $row->tgl_masuk;
            if($row->bangsal == 'ZM2'){
                $row->bangsal = 'ZAM 2' ;
            }
            else if($row->bangsal == 'PRS'){
                $row->bangsal = 'ROUD' ;
            }
            else if($row->bangsal == 'PRB'){
                $row->bangsal = 'ROUD BY' ;
            }
            else {
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
    $query = "
    SELECT a.no_reg, a.nama,t.nmdr,x.umur,a.tgl_masuk, a.jam_masuk,a.poli_id as bangsal,if(a.no_reg is not null,date(a.registered),' ') as awal, 
    if(b.no_reg is not null,'V',' ') as anak, 
    if(c.no_reg is not null,'V',' ') as geri,
    if(d.no_reg is not null,'V',' ') as gine,
    if(e.no_reg is not null,'V',' ') as imun,
    if(f.no_reg is not null,'V',' ') as bid,
    if(g.no_reg is not null,'V',' ') as neo,
    if(h.no_reg is not null,'V',' ') as rema,
    if(i.no_reg is not null,'V',' ') as post,
    if(j.no_reg is not null,date(j.registered),' ') as resum,
    if(k.no_reg is not null,'V',' ') as menul,
    if(w.no_reg is not null,'V','') as termi,
    if(w.no_reg is not null,'V',' ') as termi,
    if(l.no_reg is not null,date(l.registered),' ') as awalmd,
    if(ax.no_reg is not null,date(ax.registered),' ') as resmd
    FROM rme.askep_inap_awal a 
    LEFT JOIN  
    ( select no_reg,tgl_masuk from rme.askep_inap_tambahan_anak where deleted is null) b on b.no_reg=a.no_reg and b.tgl_masuk=a.tgl_masuk
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
      (select no_reg,tgl_masuk from rme.askep_inap_tambahan_psikiatri where deleted is null) o on o.no_reg=a.no_reg and o.tgl_masuk=a.tgl_masuk
      LEFT JOIN
      (select no_reg,tgl_masuk,registered from rme.askep_inap_summary where deleted is null) j on j.no_reg=a.no_reg and j.tgl_masuk=a.tgl_masuk
     LEFT JOIN
      (select no_reg,tgl_masuk from rme.askep_inap_tambahan_penyakit_menular where deleted is null) k on k.no_reg=a.no_reg and k.tgl_masuk=a.tgl_masuk
      LEFT JOIN  
      (select no_reg,tgl_masuk from rme.askep_inap_tambahan_terminal where deleted is null) w on w.no_reg=a.no_reg and w.tgl_masuk=a.tgl_masuk
      left join 
      (select left(rsiklaten.dokter.nama,8) as nmdr,rme.askep_inap_awal.* from rme.askep_inap_awal left join rsiklaten.dokter on dokter.no_dr=askep_inap_awal.dokter_id ) t 
      on t.no_reg=a.no_reg and t.tgl_masuk=a.tgl_masuk
      left join 
      (select rme.soap_inap.no_reg,rme.soap_inap.tgl_masuk,date(rme.soap_inap.tgl_keluar) as tgl_keluar, registered from rme.soap_inap  where rme.soap_inap.resume <> '1' and deleted is null group by rme.soap_inap.no_reg,rme.soap_inap.tgl_masuk) l 
      on l.no_reg=a.no_reg and l.tgl_masuk=a.tgl_masuk
      left join 
      (select rme.askep_inap_awal.no_reg,rme.askep_inap_awal.tgl_masuk,floor(DATEDIFF(rme.askep_inap_awal.tgl_masuk, rsiklaten.pasien.tgl_lahir)/365) as umur, registered from rme.askep_inap_awal  left join rsiklaten.pasien on rsiklaten.pasien.no_reg=rme.askep_inap_awal.no_reg where  deleted is null group by rme.askep_inap_awal.no_reg,rme.askep_inap_awal.tgl_masuk) x
      on x.no_reg = a.no_reg and x.tgl_masuk =  a.tgl_masuk
    LEFT JOIN  
    ( select no_reg,tgl_masuk from rme.askep_inap_tambahan_terminal where deleted is null) m on m.no_reg=a.no_reg and m.tgl_masuk=a.tgl_masuk
    LEFT JOIN 
         (select rme.soap_inap.no_reg,rme.soap_inap.tgl_masuk,round(DATEDIFF(rme.soap_inap.tgl_masuk, rme.soap_inap.tgl_lahir)/365,0) as umur,date(rme.soap_inap.tgl_keluar) as tgl_keluar, registered from rme.soap_inap where rme.soap_inap.resume ='1' group by rme.soap_inap.no_reg,rme.soap_inap.tgl_masuk) ax  
         on ax.no_reg=a.no_reg and ax.tgl_masuk=a.tgl_masuk
         where ax.tgl_keluar='$atanggal' and a.poli_id = '$induk'
         group by a.tgl_masuk, a.no_reg
        "; 
    $riwayat = DB::connection('slave')->select($query);
    // pre($query);
    // $riwayat = DB::select($query);
    $rows = (array) null; 
    if (!empty($riwayat)) {
        $no = 1; 
        foreach ($riwayat as $row) {
            $row = (object) $row;
            $row->no = $no; 
            $row->no_reg = $row->no_reg  ;
            $row->nama = $row->nama ;
            $row->tgl_masuk = $row->tgl_masuk;
            if($row->bangsal == 'ZM2'){
                $row->bangsal = 'ZAM 2' ;
            }
            else if($row->bangsal == 'PRS'){
                $row->bangsal = 'ROUD' ;
            }
            else if($row->bangsal == 'PRB'){
                $row->bangsal = 'ROUD BY' ;
            }
            else {
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
// echo
    
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
//  pre($data);

return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($data));