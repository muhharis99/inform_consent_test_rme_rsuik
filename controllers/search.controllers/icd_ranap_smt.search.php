<?php 
        // $this->load->model('soap_inap');
        $this->load->model('inap');
        // $this->load->model('t_grouper');
        // $this->load->model('diag_ri');

        $userid  = $this->input->get('userid');
        $no_reg  = $this->input->get('no_reg');
        $take    = $this->input->get('limit');
        $offset  = $this->input->get('offset');
        $sort    = $this->input->get('sort');
        $order   = $this->input->get('order');
        $search  = $this->input->get('search');
        $rawat  = $this->input->get('rawat');
        $atanggal = $this->input->get('atanggal');
        $btanggal = $this->input->get('btanggal');

        $atanggal = $atanggal!='' ? date("Y-m-d", strtotime($atanggal)) : date("Y-m-d"); 
        $btanggal = $btanggal!='' ? date("Y-m-d", strtotime($btanggal)) : date("Y-m-d"); 

        $row = (array) null; 
        $rows = (array) null; 
        $total = (int) 0; 
        $condition = ''; 
        // switch ($rawat) {
        //     case 'jalan' : 
        //         $condition .= "AND jnsPelayanan IN ('Rawat Jalan', 'R.Jalan') "; 
        //         break; 
        //     case 'inap' : 
        //         $condition .= "AND jnsPelayanan IN ('Rawat Inap', 'R.Inap') "; 
        //         break; 
        //     default : 
        //         // $condition .= "AND jnsPelayanan NOT IN ('Rawat Inap', 'R.Inap') "; 
        //         break; 
        // }

    //     if (empty($rawat) || $rawat == 'all') {
    //         $query = "
    //         SELECT a.id,a.no_reg,a.tgl_keluar,a.nama,a.tgl_masuk,a.jam_masuk,a.bangsal_id ,a.dpjp1 ,a.asuransi_id,FLOOR(datediff(a.tgl_masuk,a.tgl_lahir)/365) as umur,
    //    a.diagkerja as diagnosa,
    //    a.registered,
    //    b.nama2 as nama_dr,
    //    c.induk_nama as nama_poli, tarif.jumlah,
    //    max(d.Id) as done
    //         FROM rme.soap_inap a      
    //         LEFT JOIN 
    //             rsiklaten.dokter b ON a.dpjp1 = b.no_dr
    //         LEFT JOIN
    //             rme.bangsal c ON a.bangsal_id  = c.induk
    //         LEFT JOIN
    //             inacbg.diag_ri d ON a.id = d.soap_id and d.deleted is null
    //         left join (
    //             select ranap.inap.no_reg,if(t1.jumlah is null,0,t1.jumlah) + if(t2.jumlah is null, 0,t2.jumlah)+if(t3.jumlah is null, 0,t3.jumlah)+if(t4.jumlah is null, 0,t4.jumlah)+if(t5.jumlah is null, 0,t5.jumlah)+if(t6.jumlah is null, 0,t6.jumlah)+if(t7.jumlah is null, 0,t7.jumlah)+if(t8.jumlah is null, 0,t8.jumlah)+if(t9.jumlah is null, 0,t9.jumlah)+if(t10.jumlah is null, 0,t10.jumlah) as jumlah, ranap.inap.tgl_masuk from ranap.inap
	// 		left join (select no_reg, sum(bayar) as jumlah from(
    //         select fk.no_reg , fk.no_kwt , fk.bayar, fk.tgl_kwt from dbfile.`01farm_kuitansi` fk where  fk.tgl_kwt >='$atanggal' and fk.deleted is NULL and fk.rawat ='I'
    //         union all 
    //         select fk.no_reg , fk.no_kwt , fk.bayar, fk.tgl_kwt from dbfile.`06farm_kuitansi` fk where  fk.tgl_kwt >='$atanggal' and fk.deleted is NULL and fk.rawat ='I'
    //         union all 
    //         select fk.no_reg , fk.no_kwt , fk.bayar, fk.tgl_kwt from dbfile.`03farm_kuitansi` fk where  fk.tgl_kwt >='$atanggal' and fk.deleted is NULL and fk.rawat ='I'
    //         union all
    //         select fk.no_reg , fk.no_kwt , fk.bayar, fk.tgl_kwt from dbfile.`02farm_kuitansi` fk where  fk.tgl_kwt >='$atanggal' and fk.deleted is NULL 
    //         union all 
    //         select fk.no_reg , fk.no_kwt , fk.bayar, fk.tgl_kwt from dbfile.`05farm_kuitansi` fk where  fk.tgl_kwt >='$atanggal' and fk.deleted is NULL 
    //         union all 
    //         select fk.no_reg , fk.no_kwt , fk.bayar, fk.tgl_kwt from dbfile.`08farm_kuitansi` fk where  fk.tgl_kwt >='$atanggal' and fk.deleted is NULL 
    //         ) farm group by farm.no_reg)t1 on  ranap.inap.no_reg  = t1.no_reg
    //         left join
    //         (select no_reg,tanggal,sum(jumlah) as jumlah from ( 
    //         select rd.no_reg , rd.no_perk , rd.tanggal, rd.jumlah  from bill.rmina_db5 rd where  rd.tgl_masuk ='$atanggal' and deleted is null
    //         union all
    //         select rd.no_reg , rd.no_perk , rd.tanggal, rd.jumlah from bill.rarofah_db5 rd where  rd.tgl_masuk ='$atanggal' and deleted is null
    //         union all
    //         select rd.no_reg , rd.no_perk , rd.tanggal, rd.jumlah from bill.ricu_db5 rd where  rd.tgl_masuk ='$atanggal' and deleted is null
    //         union all
    //         select rd.no_reg , rd.no_perk , rd.tanggal, rd.jumlah from bill.risolasi_db5 rd where  rd.tgl_masuk ='$atanggal' and deleted is null
    //         union all
    //         select rd.no_reg , rd.no_perk , rd.tanggal, rd.jumlah from bill.rmarwah_db5 rd where  rd.tgl_masuk ='$atanggal' and deleted is null
    //         union all
    //         select rd.no_reg , rd.no_perk , rd.tanggal, rd.jumlah from bill.rshofa_db5 rd where  rd.tgl_masuk ='$atanggal' and deleted is null
    //         union all
    //         select rd.no_reg , rd.no_perk , rd.tanggal, rd.jumlah from bill.rzam_db5 rd where  rd.tgl_masuk ='$atanggal' and deleted is null
    //         union all
    //         select rd.no_reg , rd.no_perk , rd.tanggal, rd.jumlah from bill.rzam2_db5 rd where  rd.tgl_masuk ='$atanggal' and deleted is null
    //         union all
    //         select rd.no_reg , rd.no_perk , rd.tanggal, rd.jumlah from bill.rsiti_h_db5 rd where  rd.tgl_masuk ='$atanggal' and deleted is null
    //         union all
    //         select rd.no_reg , rd.no_perk , rd.tanggal, rd.jumlah from bill.rvk_db5 rd where  rd.tgl_masuk ='$atanggal' and deleted is null
    //         union all
    //         select rd.no_reg , rd.no_perk , rd.tanggal, rd.jumlah from bill.rpicu_db5 rd where  rd.tgl_masuk ='$atanggal' and deleted is null
    //         union all
    //         select rd.no_reg , rd.no_perk , rd.tanggal, rd.jumlah from bill.rjblnur_db5 rd where  rd.tgl_masuk ='$atanggal' and deleted is null
    //         ) bgs group by bgs.no_reg) t2
    //         on ranap.inap.no_reg = t2.no_reg
    //         left join (
    //         select ldi.no_reg , ldi.tanggal , sum(ldi.jumlah) as jumlah  from bill.lab_db5i ldi where ldi.tgl_masuk ='$atanggal' and deleted is null
    //         group by ldi.no_reg
    //         ) t3 on ranap.inap.no_reg =t3.no_reg
    //         left join (
    //         select ldi.no_reg , ldi.tanggal , sum(ldi.jumlah) as jumlah  from bill.ro_db5i ldi where ldi.tgl_masuk ='$atanggal' and deleted is null
    //         group by ldi.no_reg
    //         ) t4 on ranap.inap.no_reg =t4.no_reg 
    //         left join (
    //             select jd.no_reg , jd.tanggal , sum(jd.jumlah) as jumlah  from bill.jantung_db5 jd  where jd.tgl_masuk ='$atanggal' and deleted is null
    //             group by jd.no_reg
    //             ) t5 on ranap.inap.no_reg = t5.no_reg
    //             left join (
    //             select jd.no_reg , jd.tanggal , sum(jd.jumlah) as jumlah  from bill.sps_db5 jd  where jd.tgl_masuk ='$atanggal' and deleted is null
    //             group by jd.no_reg
    //             ) t6 on ranap.inap.no_reg = t6.no_reg
    //             left join (
    //             select jd.no_reg , jd.tanggal , sum(jd.jumlah) as jumlah  from bill.gigi_db5 jd  where jd.tgl_masuk ='$atanggal' and deleted is null
    //             group by jd.no_reg
    //             ) t7 on ranap.inap.no_reg = t7.no_reg
    //             left join (
    //             select jd.no_reg , jd.tanggal , sum(jd.jumlah) as jumlah  from bill.rhmed_db5  jd  where jd.tgl_masuk ='$atanggal' and deleted is null
    //             group by jd.no_reg
    //             ) t8 on ranap.inap.no_reg = t8.no_reg
    //             left join (
    //             select jd.no_reg , jd.tanggal , sum(jd.jumlah) as jumlah  from bill.eeg_db5 jd  where jd.tgl_masuk ='$atanggal' and deleted is null
    //             group by jd.no_reg
    //             ) t9 on ranap.inap.no_reg = t9.no_reg
    //             left join (
    //             select jd.no_reg , jd.tanggal , sum(jd.jumlah) as jumlah  from bill.ugd_db5 jd  where jd.tgl_masuk ='$atanggal' and deleted is null
    //             group by jd.no_reg
    //             ) t10 on ranap.inap.no_reg = t10.no_reg
    //         ) tarif on tarif.no_reg = a.no_reg 
    //         WHERE 
    //         date(a.tgl_masuk) >= '$atanggal' AND date(a.tgl_masuk) <='$btanggal'
    //         AND
    //         a.asuransi_id IN ('300','301','302','303','304','305','306')
    //         AND a.resume<>'1' 
    //         AND a.deleted is null
    //         GROUP BY a.no_reg,a.tgl_masuk
    //         "; 
    //         // if (ipclient()==IPC) pre($query);
    //     }else {
    //         $query = "
    //         SELECT a.id,a.no_reg,a.nama,a.tgl_keluar,a.tgl_masuk,a.jam_masuk,a.bangsal_id as kd_poli,a.dpjp1 ,a.asuransi_id,FLOOR(datediff(a.tgl_masuk,a.tgl_lahir)/365) as umur,
    //    a.diagkerja as diagnosa ,
    //    a.registered,
    //    b.nama2 as nama_dr,
    //    c.induk_nama as nama_poli,tarif.jumlah,
    //    d.Id as done
    //         FROM rme.soap_inap a      
    //         LEFT JOIN 
    //             rsiklaten.dokter b ON a.dpjp1 = b.no_dr
    //         JOIN
    //             rme.bangsal c ON a.bangsal_id  = c.induk
    //         LEFT JOIN
    //             inacbg.diag_ri d ON a.id = d.soap_id and d.deleted is null
    //             left join (
    //                 select ranap.inap.no_reg,if(t1.jumlah is null,0,t1.jumlah) + if(t2.jumlah is null, 0,t2.jumlah)+if(t3.jumlah is null, 0,t3.jumlah)+if(t4.jumlah is null, 0,t4.jumlah)+if(t5.jumlah is null, 0,t5.jumlah)+if(t6.jumlah is null, 0,t6.jumlah)+if(t7.jumlah is null, 0,t7.jumlah)+if(t8.jumlah is null, 0,t8.jumlah)+if(t9.jumlah is null, 0,t9.jumlah)+if(t10.jumlah is null, 0,t10.jumlah) as jumlah, ranap.inap.tgl_masuk from ranap.inap
    //             left join (select no_reg, sum(bayar) as jumlah from(
    //             select fk.no_reg , fk.no_kwt , fk.bayar, fk.tgl_kwt from dbfile.`01farm_kuitansi` fk where  fk.tgl_kwt >='$atanggal' and fk.deleted is NULL and fk.rawat ='I'
    //             union all 
    //             select fk.no_reg , fk.no_kwt , fk.bayar, fk.tgl_kwt from dbfile.`06farm_kuitansi` fk where  fk.tgl_kwt >='$atanggal' and fk.deleted is NULL and fk.rawat ='I'
    //             union all 
    //             select fk.no_reg , fk.no_kwt , fk.bayar, fk.tgl_kwt from dbfile.`03farm_kuitansi` fk where  fk.tgl_kwt >='$atanggal' and fk.deleted is NULL and fk.rawat ='I'
    //             union all
    //             select fk.no_reg , fk.no_kwt , fk.bayar, fk.tgl_kwt from dbfile.`02farm_kuitansi` fk where  fk.tgl_kwt >='$atanggal' and fk.deleted is NULL 
    //             union all 
    //             select fk.no_reg , fk.no_kwt , fk.bayar, fk.tgl_kwt from dbfile.`05farm_kuitansi` fk where  fk.tgl_kwt >='$atanggal' and fk.deleted is NULL 
    //             union all 
    //             select fk.no_reg , fk.no_kwt , fk.bayar, fk.tgl_kwt from dbfile.`08farm_kuitansi` fk where  fk.tgl_kwt >='$atanggal' and fk.deleted is NULL 
    //             ) farm group by farm.no_reg)t1 on  ranap.inap.no_reg  = t1.no_reg
    //             left join
    //             (select no_reg,tanggal,sum(jumlah) as jumlah from ( 
    //             select rd.no_reg , rd.no_perk , rd.tanggal, rd.jumlah  from bill.rmina_db5 rd where  rd.tgl_masuk ='$atanggal' and deleted is null
    //             union all
    //             select rd.no_reg , rd.no_perk , rd.tanggal, rd.jumlah from bill.rarofah_db5 rd where  rd.tgl_masuk ='$atanggal' and deleted is null
    //             union all
    //             select rd.no_reg , rd.no_perk , rd.tanggal, rd.jumlah from bill.ricu_db5 rd where  rd.tgl_masuk ='$atanggal' and deleted is null
    //             union all
    //             select rd.no_reg , rd.no_perk , rd.tanggal, rd.jumlah from bill.risolasi_db5 rd where  rd.tgl_masuk ='$atanggal' and deleted is null
    //             union all
    //             select rd.no_reg , rd.no_perk , rd.tanggal, rd.jumlah from bill.rmarwah_db5 rd where  rd.tgl_masuk ='$atanggal' and deleted is null
    //             union all
    //             select rd.no_reg , rd.no_perk , rd.tanggal, rd.jumlah from bill.rshofa_db5 rd where  rd.tgl_masuk ='$atanggal' and deleted is null
    //             union all
    //             select rd.no_reg , rd.no_perk , rd.tanggal, rd.jumlah from bill.rzam_db5 rd where  rd.tgl_masuk ='$atanggal' and deleted is null
    //             union all
    //             select rd.no_reg , rd.no_perk , rd.tanggal, rd.jumlah from bill.rzam2_db5 rd where  rd.tgl_masuk ='$atanggal' and deleted is null
    //             union all
    //             select rd.no_reg , rd.no_perk , rd.tanggal, rd.jumlah from bill.rsiti_h_db5 rd where  rd.tgl_masuk ='$atanggal' and deleted is null
    //             union all
    //             select rd.no_reg , rd.no_perk , rd.tanggal, rd.jumlah from bill.rvk_db5 rd where  rd.tgl_masuk ='$atanggal' and deleted is null
    //             union all
    //             select rd.no_reg , rd.no_perk , rd.tanggal, rd.jumlah from bill.rpicu_db5 rd where  rd.tgl_masuk ='$atanggal' and deleted is null
    //             union all
    //             select rd.no_reg , rd.no_perk , rd.tanggal, rd.jumlah from bill.rjblnur_db5 rd where  rd.tgl_masuk ='$atanggal' and deleted is null
    //             ) bgs group by bgs.no_reg) t2
    //             on ranap.inap.no_reg = t2.no_reg
    //             left join (
    //             select ldi.no_reg , ldi.tanggal , sum(ldi.jumlah) as jumlah  from bill.lab_db5i ldi where ldi.tgl_masuk ='$atanggal' and deleted is null
    //             group by ldi.no_reg
    //             ) t3 on ranap.inap.no_reg =t3.no_reg
    //             left join (
    //             select ldi.no_reg , ldi.tanggal , sum(ldi.jumlah) as jumlah  from bill.ro_db5i ldi where ldi.tgl_masuk ='$atanggal' and deleted is null
    //             group by ldi.no_reg
    //             ) t4 on ranap.inap.no_reg =t4.no_reg 
    //             left join (
    //                 select jd.no_reg , jd.tanggal , sum(jd.jumlah) as jumlah  from bill.jantung_db5 jd  where jd.tgl_masuk ='$atanggal' and deleted is null
    //                 group by jd.no_reg
    //                 ) t5 on ranap.inap.no_reg = t5.no_reg
    //                 left join (
    //                 select jd.no_reg , jd.tanggal , sum(jd.jumlah) as jumlah  from bill.sps_db5 jd  where jd.tgl_masuk ='$atanggal' and deleted is null
    //                 group by jd.no_reg
    //                 ) t6 on ranap.inap.no_reg = t6.no_reg
    //                 left join (
    //                 select jd.no_reg , jd.tanggal , sum(jd.jumlah) as jumlah  from bill.gigi_db5 jd  where jd.tgl_masuk ='$atanggal' and deleted is null
    //                 group by jd.no_reg
    //                 ) t7 on ranap.inap.no_reg = t7.no_reg
    //                 left join (
    //                 select jd.no_reg , jd.tanggal , sum(jd.jumlah) as jumlah  from bill.rhmed_db5  jd  where jd.tgl_masuk ='$atanggal' and deleted is null
    //                 group by jd.no_reg
    //                 ) t8 on ranap.inap.no_reg = t8.no_reg
    //                 left join (
    //                 select jd.no_reg , jd.tanggal , sum(jd.jumlah) as jumlah  from bill.eeg_db5 jd  where jd.tgl_masuk ='$atanggal' and deleted is null
    //                 group by jd.no_reg
    //                 ) t9 on ranap.inap.no_reg = t9.no_reg
    //                 left join (
    //                 select jd.no_reg , jd.tanggal , sum(jd.jumlah) as jumlah  from bill.ugd_db5 jd  where jd.tgl_masuk ='$atanggal' and deleted is null
    //                 group by jd.no_reg
    //                 ) t10 on ranap.inap.no_reg = t10.no_reg
    //             ) tarif on tarif.no_reg = a.no_reg 
    //         WHERE 
    //             date(a.tgl_masuk) >= '$atanggal' AND date(a.tgl_masuk) <='$btanggal'
    //         AND
    //          a.asuransi_id IN ('300','301','302','303','304','305','306')
    //             AND
    //              a.resume<>'1' 
    //             AND
    //              a.deleted is null
    //             AND
    //             a.bangsal_id = '$rawat'
    //         #AND 
	//             #a.kd_poli NOT IN ('F002','F003')
    //         #GROUP BY a.id
    //         GROUP BY a.no_reg,a.tgl_masuk
    //         "; 
    //     }

    // new code
    if (empty($rawat) || $rawat == 'all') {
        $query = "
        SELECT a.id,a.no_reg,a.nama,a.tgl_masuk,a.jam_masuk,a.kd_bangsal as bangsal_id ,a.dpjp1 ,tg.gruper,tg.icd1,a.kd_asuransi as asuransi_id ,FLOOR(datediff(a.tgl_masuk,a.tgl_lahir)/365) as umur,
   a.registered,
   b.nama2 as nama_dr,
   c.induk_nama as nama_poli, tarif.jumlah + if(isnull(tibs.jumlah),'0',tibs.jumlah) as jumlah,if(tg.kelas is null,0,if(tg.kelas ='III',tg.tarif_3,if(tg.kelas ='II',tg.tarif_2, tg.tarif_1))) as tr_grouper,
   max(d.Id) as done
        FROM ranap.inap a 
        left join  
        (select * from inacbg.tarif_ibs where deleted is null) tibs on tibs.no_reg=a.no_reg and tibs.tgl_masuk = a.tgl_ri    
        LEFT JOIN 
            rsiklaten.dokter b ON a.dpjp1 = b.no_dr
        LEFT JOIN
            rme.bangsal c ON left(a.kd_bangsal,3)  = c.induk 
        LEFT JOIN
            inacbg.diag_ri d ON a.id = d.soap_id and d.deleted is null
        left join (
        select ranap.inap.no_reg,if(t1.jumlah is null,0,t1.jumlah)+ if(t2.jumlah is null, 0,t2.jumlah)+if(t3.jumlah is null, 0,t3.jumlah)+if(t4.jumlah is null, 0,t4.jumlah)+if(t5.jumlah is null, 0,t5.jumlah)+if(t6.jumlah is null, 0,t6.jumlah)
        +if(t7.jumlah is null, 0,t7.jumlah)+if(t8.jumlah is null, 0,t8.jumlah)+if(t9.jumlah is null, 0,t9.jumlah)+if(t10.jumlah is null, 0,t10.jumlah)
        as jumlah, ranap.inap.tgl_masuk from ranap.inap
        left join (select no_reg, sum(bayar) as jumlah from(
        select fk.no_reg , fk.no_kwt , fk.bayar, fk.tgl_kwt from dbfile.`01farm_kuitansi` fk 
        left join ranap.inap on ranap.inap.no_reg=fk.no_reg 
        where  fk.tgl_kwt >=ranap.inap.tgl_masuk  and fk.deleted is NULL and fk.rawat ='I'
        union all 
        select fk.no_reg , fk.no_kwt , fk.bayar, fk.tgl_kwt from dbfile.`06farm_kuitansi` fk 
        left join ranap.inap on ranap.inap.no_reg=fk.no_reg
        where  fk.tgl_kwt >=ranap.inap.tgl_masuk  and fk.deleted is NULL and fk.rawat ='I'
        union all 
        select fk.no_reg , fk.no_kwt , fk.bayar, fk.tgl_kwt from dbfile.`03farm_kuitansi` fk 
        left join ranap.inap on ranap.inap.no_reg=fk.no_reg
        where  fk.tgl_kwt >=ranap.inap.tgl_masuk and fk.deleted is NULL and fk.rawat ='I'
        union all
        select fk.no_reg , fk.no_kwt , fk.bayar, fk.tgl_kwt from dbfile.`02farm_kuitansi` fk 
        left join ranap.inap on ranap.inap.no_reg=fk.no_reg
        where  fk.tgl_kwt >=ranap.inap.tgl_masuk and fk.deleted is NULL 
        union all 
        select fk.no_reg , fk.no_kwt , fk.bayar, fk.tgl_kwt from dbfile.`05farm_kuitansi` fk 
        left join ranap.inap on ranap.inap.no_reg=fk.no_reg
        where  fk.tgl_kwt >=ranap.inap.tgl_masuk and fk.deleted is NULL 
        union all 
        select fk.no_reg , fk.no_kwt , fk.bayar, fk.tgl_kwt from dbfile.`08farm_kuitansi` fk 
        left join ranap.inap on ranap.inap.no_reg=fk.no_reg
        where  fk.tgl_kwt >=ranap.inap.tgl_masuk and fk.deleted is NULL 
        ) farm group by farm.no_reg)t1 on  ranap.inap.no_reg  = t1.no_reg               
        left join
        (select no_reg,tanggal,sum(jumlah) as jumlah from ( 
        select rd.no_reg , rd.no_perk , rd.tanggal, rd.jumlah  from bill.rmina_db5 rd 
        left join ranap.inap ri on ri.no_reg=rd.no_reg and ri.tgl_masuk=rd.tgl_masuk
        where  rd.tgl_masuk =ri.tgl_masuk and deleted is null
        union all
        select rd.no_reg , rd.no_perk , rd.tanggal, rd.jumlah from bill.rarofah_db5 rd 
        left join ranap.inap ri on ri.no_reg=rd.no_reg and ri.tgl_masuk=rd.tgl_masuk
        where  rd.tgl_masuk =ri.tgl_masuk and deleted is null
        union all
        select rd.no_reg , rd.no_perk , rd.tanggal, rd.jumlah from bill.ricu_db5 rd 
        left join ranap.inap ri on ri.no_reg=rd.no_reg and ri.tgl_masuk=rd.tgl_masuk
        where  rd.tgl_masuk =ri.tgl_masuk and deleted is null
        union all
        select rd.no_reg , rd.no_perk , rd.tanggal, rd.jumlah from bill.risolasi_db5 rd 
        left join ranap.inap ri on ri.no_reg=rd.no_reg and ri.tgl_masuk=rd.tgl_masuk
        where  rd.tgl_masuk =ri.tgl_masuk and deleted is null
        union all
        select rd.no_reg , rd.no_perk , rd.tanggal, rd.jumlah from bill.rmarwah_db5 rd 
          left join ranap.inap ri on ri.no_reg=rd.no_reg and ri.tgl_masuk=rd.tgl_masuk
        where  rd.tgl_masuk =ri.tgl_masuk and deleted is null
        union all
        select rd.no_reg , rd.no_perk , rd.tanggal, rd.jumlah from bill.rshofa_db5 rd 
           left join ranap.inap ri on ri.no_reg=rd.no_reg and ri.tgl_masuk=rd.tgl_masuk
        where  rd.tgl_masuk =ri.tgl_masuk and deleted is null
        union all
        select rd.no_reg , rd.no_perk , rd.tanggal, rd.jumlah from bill.rzam_db5 rd 
         left join ranap.inap ri on ri.no_reg=rd.no_reg and ri.tgl_masuk=rd.tgl_masuk
        where  rd.tgl_masuk =ri.tgl_masuk and deleted is null
        union all
        select rd.no_reg , rd.no_perk , rd.tanggal, rd.jumlah from bill.rzam2_db5 rd 
          left join ranap.inap ri on ri.no_reg=rd.no_reg and ri.tgl_masuk=rd.tgl_masuk
        where  rd.tgl_masuk =ri.tgl_masuk and deleted is null
        union all
        select rd.no_reg , rd.no_perk , rd.tanggal, rd.jumlah from bill.rsiti_h_db5 rd 
        left join ranap.inap ri on ri.no_reg=rd.no_reg and ri.tgl_masuk=rd.tgl_masuk
        where  rd.tgl_masuk =ri.tgl_masuk and deleted is null
        union all
        select rd.no_reg , rd.no_perk , rd.tanggal, rd.jumlah from bill.rvk_db5 rd 
        left join ranap.inap ri on ri.no_reg=rd.no_reg and ri.tgl_masuk=rd.tgl_masuk
        where  rd.tgl_masuk =ri.tgl_masuk and deleted is null
           union all
        select rd.no_reg , rd.no_perk , rd.tanggal, rd.jumlah from bill.rpicu_db5 rd 
        left join ranap.inap ri on ri.no_reg=rd.no_reg and ri.tgl_masuk=rd.tgl_masuk
        where  rd.tgl_masuk =ri.tgl_masuk and deleted is null
        union all
        select rd.no_reg , rd.no_perk , rd.tanggal, rd.jumlah from bill.rjblnur_db5 rd
           left join ranap.inap ri on ri.no_reg=rd.no_reg and ri.tgl_masuk=rd.tgl_masuk
        where  rd.tgl_masuk =ri.tgl_masuk and deleted is null
        ) bgs group by bgs.no_reg) t2
        on ranap.inap.no_reg = t2.no_reg
        left join (
        select ldi.no_reg , ldi.tanggal , sum(ldi.jumlah) as jumlah  from bill.lab_db5i ldi 
        left join ranap.inap ri on ri.no_reg=ldi.no_reg 
        where  jumlah>0 and deleted is null and ldi.tanggal >=ri.tgl_masuk
        group by ldi.no_reg
        ) t3 on ranap.inap.no_reg =t3.no_reg
        left join (
        select ldi.no_reg , ldi.tanggal ,sum(ldi.jumlah) as jumlah  from bill.ro_db5i ldi 
        left join ranap.inap ri on ri.no_reg=ldi.no_reg 
        where deleted is null and  ldi.tanggal >=ri.tgl_masuk 
        group by ldi.no_reg,ldi.tanggal
        ) t4 on ranap.inap.no_reg =t4.no_reg 
        left join (
            select jd.no_reg , jd.tanggal , sum(jd.jumlah) as jumlah  from bill.jantung_db5 jd
            left join ranap.inap ri on ri.no_reg=jd.no_reg
            where jd.tanggal >=ri.tgl_masuk and deleted is null
            group by jd.no_reg
            ) t5 on ranap.inap.no_reg = t5.no_reg
            left join (
            select jd.no_reg , jd.tanggal , sum(jd.jumlah) as jumlah  from bill.sps_db5 jd  
            left join ranap.inap ri on ri.no_reg=jd.no_reg
            where jd.tanggal >=ri.tgl_masuk and deleted is null
            group by jd.no_reg
            ) t6 on ranap.inap.no_reg = t6.no_reg
            left join (
            select jd.no_reg , jd.tanggal , sum(jd.jumlah) as jumlah  from bill.gigi_db5 jd  
             left join ranap.inap ri on ri.no_reg=jd.no_reg
            where jd.tanggal >=ri.tgl_masuk and deleted is null
            group by jd.no_reg
            ) t7 on ranap.inap.no_reg = t7.no_reg
            left join (
            select jd.no_reg , jd.tanggal , sum(jd.jumlah) as jumlah  from bill.rhmed_db5  jd  
            left join ranap.inap ri on ri.no_reg=jd.no_reg
            where jd.tanggal >=ri.tgl_masuk and deleted is null
            group by jd.no_reg
            ) t8 on ranap.inap.no_reg = t8.no_reg
            left join (
            select jd.no_reg , jd.tanggal , sum(jd.jumlah) as jumlah  from bill.eeg_db5 jd  
            left join ranap.inap ri on ri.no_reg=jd.no_reg
            where jd.tanggal >=ri.tgl_masuk and deleted is null
            group by jd.no_reg
            ) t9 on ranap.inap.no_reg = t9.no_reg
            left join (
            select jd.no_reg , jd.tanggal , sum(jd.jumlah) as jumlah  from bill.ugd_db5 jd  
            left join ranap.inap ri on ri.no_reg=jd.no_reg
            where jd.tanggal >=ri.tgl_masuk and deleted is null
            group by jd.no_reg
            ) t10 on ranap.inap.no_reg = t10.no_reg
        ) tarif on tarif.no_reg = a.no_reg 
        left join 
        (select * from inacbg.t_gruper where deleted ='0') tg on tg.no_reg= a.no_reg and tg.tgl_ri = a.tgl_ri
        WHERE 
        a.kd_asuransi IN ('300','301','302','303','304','305','306') 
        GROUP BY a.no_reg,a.tgl_masuk    
        "; 
        // if (ipclient()==IPC) pre($query);
    }else if ($rawat == 'KBR'){
        $query = "
        SELECT a.id,a.no_reg,a.nama,a.tgl_masuk,a.jam_masuk,a.kd_bangsal as bangsal_id ,tg.gruper,tg.icd1,a.dpjp1 ,a.kd_asuransi as asuransi_id ,FLOOR(datediff(a.tgl_masuk,a.tgl_lahir)/365) as umur,
   a.registered,
   b.nama2 as nama_dr,
   a.kd_bangsal as nama_poli, tarif.jumlah,if(tg.kelas is null,0,if(tg.kelas ='III',tg.tarif_3,if(tg.kelas ='II',tg.tarif_2, tg.tarif_1))) as tr_grouper,
        FROM ranap.inap a      
        LEFT JOIN 
            rsiklaten.dokter b ON a.dpjp1 = b.no_dr
        LEFT JOIN
            rme.bangsal c ON left(a.kd_bangsal,3)  = c.induk 
        LEFT JOIN
            inacbg.diag_ri d ON a.id = d.soap_id and d.deleted is null
        left join (
        select ranap.inap.no_reg,if(t1.jumlah is null,0,t1.jumlah)+ if(t2.jumlah is null, 0,t2.jumlah)+if(t3.jumlah is null, 0,t3.jumlah)+if(t4.jumlah is null, 0,t4.jumlah)+if(t5.jumlah is null, 0,t5.jumlah)+if(t6.jumlah is null, 0,t6.jumlah)
        +if(t7.jumlah is null, 0,t7.jumlah)+if(t8.jumlah is null, 0,t8.jumlah)+if(t9.jumlah is null, 0,t9.jumlah)+if(t10.jumlah is null, 0,t10.jumlah)
        as jumlah, ranap.inap.tgl_masuk from ranap.inap
        left join (select no_reg, sum(bayar) as jumlah from(
        select fk.no_reg , fk.no_kwt , fk.bayar, fk.tgl_kwt from dbfile.`01farm_kuitansi` fk 
        left join ranap.inap on ranap.inap.no_reg=fk.no_reg 
        where  fk.tgl_kwt >=ranap.inap.tgl_masuk  and fk.deleted is NULL and fk.rawat ='I'
        union all 
        select fk.no_reg , fk.no_kwt , fk.bayar, fk.tgl_kwt from dbfile.`06farm_kuitansi` fk 
        left join ranap.inap on ranap.inap.no_reg=fk.no_reg
        where  fk.tgl_kwt >=ranap.inap.tgl_masuk  and fk.deleted is NULL and fk.rawat ='I'
        union all 
        select fk.no_reg , fk.no_kwt , fk.bayar, fk.tgl_kwt from dbfile.`03farm_kuitansi` fk 
        left join ranap.inap on ranap.inap.no_reg=fk.no_reg
        where  fk.tgl_kwt >=ranap.inap.tgl_masuk and fk.deleted is NULL and fk.rawat ='I'
        union all
        select fk.no_reg , fk.no_kwt , fk.bayar, fk.tgl_kwt from dbfile.`02farm_kuitansi` fk 
        left join ranap.inap on ranap.inap.no_reg=fk.no_reg
        where  fk.tgl_kwt >=ranap.inap.tgl_masuk and fk.deleted is NULL 
        union all 
        select fk.no_reg , fk.no_kwt , fk.bayar, fk.tgl_kwt from dbfile.`05farm_kuitansi` fk 
        left join ranap.inap on ranap.inap.no_reg=fk.no_reg
        where  fk.tgl_kwt >=ranap.inap.tgl_masuk and fk.deleted is NULL 
        union all 
        select fk.no_reg , fk.no_kwt , fk.bayar, fk.tgl_kwt from dbfile.`08farm_kuitansi` fk 
        left join ranap.inap on ranap.inap.no_reg=fk.no_reg
        where  fk.tgl_kwt >=ranap.inap.tgl_masuk and fk.deleted is NULL 
        ) farm group by farm.no_reg)t1 on  ranap.inap.no_reg  = t1.no_reg               
        left join
        (select no_reg,tanggal,sum(jumlah) as jumlah from ( 
        select rd.no_reg , rd.no_perk , rd.tanggal, rd.jumlah  from bill.rmina_db5 rd 
        left join ranap.inap ri on ri.no_reg=rd.no_reg and ri.tgl_masuk=rd.tgl_masuk
        where  rd.tgl_masuk =ri.tgl_masuk and deleted is null
        union all
        select rd.no_reg , rd.no_perk , rd.tanggal, rd.jumlah from bill.rarofah_db5 rd 
        left join ranap.inap ri on ri.no_reg=rd.no_reg and ri.tgl_masuk=rd.tgl_masuk
        where  rd.tgl_masuk =ri.tgl_masuk and deleted is null
        union all
        select rd.no_reg , rd.no_perk , rd.tanggal, rd.jumlah from bill.ricu_db5 rd 
        left join ranap.inap ri on ri.no_reg=rd.no_reg and ri.tgl_masuk=rd.tgl_masuk
        where  rd.tgl_masuk =ri.tgl_masuk and deleted is null
        union all
        select rd.no_reg , rd.no_perk , rd.tanggal, rd.jumlah from bill.risolasi_db5 rd 
        left join ranap.inap ri on ri.no_reg=rd.no_reg and ri.tgl_masuk=rd.tgl_masuk
        where  rd.tgl_masuk =ri.tgl_masuk and deleted is null
        union all
        select rd.no_reg , rd.no_perk , rd.tanggal, rd.jumlah from bill.rmarwah_db5 rd 
          left join ranap.inap ri on ri.no_reg=rd.no_reg and ri.tgl_masuk=rd.tgl_masuk
        where  rd.tgl_masuk =ri.tgl_masuk and deleted is null
        union all
        select rd.no_reg , rd.no_perk , rd.tanggal, rd.jumlah from bill.rshofa_db5 rd 
           left join ranap.inap ri on ri.no_reg=rd.no_reg and ri.tgl_masuk=rd.tgl_masuk
        where  rd.tgl_masuk =ri.tgl_masuk and deleted is null
        union all
        select rd.no_reg , rd.no_perk , rd.tanggal, rd.jumlah from bill.rzam_db5 rd 
         left join ranap.inap ri on ri.no_reg=rd.no_reg and ri.tgl_masuk=rd.tgl_masuk
        where  rd.tgl_masuk =ri.tgl_masuk and deleted is null
        union all
        select rd.no_reg , rd.no_perk , rd.tanggal, rd.jumlah from bill.rzam2_db5 rd 
          left join ranap.inap ri on ri.no_reg=rd.no_reg and ri.tgl_masuk=rd.tgl_masuk
        where  rd.tgl_masuk =ri.tgl_masuk and deleted is null
        union all
        select rd.no_reg , rd.no_perk , rd.tanggal, rd.jumlah from bill.rsiti_h_db5 rd 
        left join ranap.inap ri on ri.no_reg=rd.no_reg and ri.tgl_masuk=rd.tgl_masuk
        where  rd.tgl_masuk =ri.tgl_masuk and deleted is null
        union all
        select rd.no_reg , rd.no_perk , rd.tanggal, rd.jumlah from bill.rvk_db5 rd 
        left join ranap.inap ri on ri.no_reg=rd.no_reg and ri.tgl_masuk=rd.tgl_masuk
        where  rd.tgl_masuk =ri.tgl_masuk and deleted is null
           union all
        select rd.no_reg , rd.no_perk , rd.tanggal, rd.jumlah from bill.rpicu_db5 rd 
        left join ranap.inap ri on ri.no_reg=rd.no_reg and ri.tgl_masuk=rd.tgl_masuk
        where  rd.tgl_masuk =ri.tgl_masuk and deleted is null
        union all
        select rd.no_reg , rd.no_perk , rd.tanggal, rd.jumlah from bill.rjblnur_db5 rd
           left join ranap.inap ri on ri.no_reg=rd.no_reg and ri.tgl_masuk=rd.tgl_masuk
        where  rd.tgl_masuk =ri.tgl_masuk and deleted is null
        ) bgs group by bgs.no_reg) t2
        on ranap.inap.no_reg = t2.no_reg
        left join (
        select ldi.no_reg , ldi.tanggal , sum(ldi.jumlah) as jumlah  from bill.lab_db5i ldi 
        left join ranap.inap ri on ri.no_reg=ldi.no_reg 
        where  jumlah>0 and deleted is null and ldi.tanggal >=ri.tgl_masuk
        group by ldi.no_reg
        ) t3 on ranap.inap.no_reg =t3.no_reg
        left join (
        select ldi.no_reg , ldi.tanggal ,sum(ldi.jumlah) as jumlah  from bill.ro_db5i ldi 
        left join ranap.inap ri on ri.no_reg=ldi.no_reg 
        where deleted is null and  ldi.tanggal >=ri.tgl_masuk 
        group by ldi.no_reg,ldi.tanggal
        ) t4 on ranap.inap.no_reg =t4.no_reg 
        left join (
            select jd.no_reg , jd.tanggal , sum(jd.jumlah) as jumlah  from bill.jantung_db5 jd
            left join ranap.inap ri on ri.no_reg=jd.no_reg
            where jd.tanggal >=ri.tgl_masuk and deleted is null
            group by jd.no_reg
            ) t5 on ranap.inap.no_reg = t5.no_reg
            left join (
            select jd.no_reg , jd.tanggal , sum(jd.jumlah) as jumlah  from bill.sps_db5 jd  
            left join ranap.inap ri on ri.no_reg=jd.no_reg
            where jd.tanggal >=ri.tgl_masuk and deleted is null
            group by jd.no_reg
            ) t6 on ranap.inap.no_reg = t6.no_reg
            left join (
            select jd.no_reg , jd.tanggal , sum(jd.jumlah) as jumlah  from bill.gigi_db5 jd  
             left join ranap.inap ri on ri.no_reg=jd.no_reg
            where jd.tanggal >=ri.tgl_masuk and deleted is null
            group by jd.no_reg
            ) t7 on ranap.inap.no_reg = t7.no_reg
            left join (
            select jd.no_reg , jd.tanggal , sum(jd.jumlah) as jumlah  from bill.rhmed_db5  jd  
            left join ranap.inap ri on ri.no_reg=jd.no_reg
            where jd.tanggal >=ri.tgl_masuk and deleted is null
            group by jd.no_reg
            ) t8 on ranap.inap.no_reg = t8.no_reg
            left join (
            select jd.no_reg , jd.tanggal , sum(jd.jumlah) as jumlah  from bill.eeg_db5 jd  
            left join ranap.inap ri on ri.no_reg=jd.no_reg
            where jd.tanggal >=ri.tgl_masuk and deleted is null
            group by jd.no_reg
            ) t9 on ranap.inap.no_reg = t9.no_reg
            left join (
            select jd.no_reg , jd.tanggal , sum(jd.jumlah) as jumlah  from bill.ugd_db5 jd  
            left join ranap.inap ri on ri.no_reg=jd.no_reg
            where jd.tanggal >=ri.tgl_masuk and deleted is null
            group by jd.no_reg
            ) t10 on ranap.inap.no_reg = t10.no_reg
        ) tarif on tarif.no_reg = a.no_reg 
        left join
        (select * from inacbg.t_gruper where deleted ='0') tg on tg.no_reg= a.no_reg and tg.tgl_ri = a.tgl_ri
        WHERE      
        a.kd_asuransi IN ('300','301','302','303','304','305','306')
        and left(a.kd_bangsal,3) in ('PIC','NC1','NC2','NC3') 
        GROUP BY a.no_reg,a.tgl_masuk    
        "; 
    }else {
        $query = "
        SELECT a.id,a.no_reg,a.nama,a.tgl_masuk,a.jam_masuk,a.kd_bangsal as bangsal_id ,a.dpjp1,tg.gruper,tg.icd1,a.kd_asuransi as asuransi_id ,FLOOR(datediff(a.tgl_masuk,a.tgl_lahir)/365) as umur,
   a.registered,
   b.nama2 as nama_dr,
   c.induk_nama as nama_poli, tarif.jumlah  + if(isnull(tibs.jumlah),'0',tibs.jumlah) as jumlah,if(tg.kelas is null,0,if(tg.kelas ='III',tg.tarif_3,if(tg.kelas ='II',tg.tarif_2, tg.tarif_1))) as tr_grouper,
   max(d.Id) as done
        FROM ranap.inap a      
        left join 
        (select * from inacbg.tarif_ibs where deleted is null) tibs on tibs.no_reg=a.no_reg and tibs.tgl_masuk = a.tgl_ri
        LEFT JOIN 
            rsiklaten.dokter b ON a.dpjp1 = b.no_dr
        LEFT JOIN
            rme.bangsal c ON left(a.kd_bangsal,3)  = c.induk 
        LEFT JOIN
            inacbg.diag_ri d ON a.id = d.soap_id and d.deleted is null
        left join (
        select ranap.inap.no_reg,if(t1.jumlah is null,0,t1.jumlah)+ if(t2.jumlah is null, 0,t2.jumlah)+if(t3.jumlah is null, 0,t3.jumlah)+if(t4.jumlah is null, 0,t4.jumlah)+if(t5.jumlah is null, 0,t5.jumlah)+if(t6.jumlah is null, 0,t6.jumlah)
        +if(t7.jumlah is null, 0,t7.jumlah)+if(t8.jumlah is null, 0,t8.jumlah)+if(t9.jumlah is null, 0,t9.jumlah)+if(t10.jumlah is null, 0,t10.jumlah)
        as jumlah, ranap.inap.tgl_masuk from ranap.inap
        left join (select no_reg, sum(bayar) as jumlah from(
        select fk.no_reg , fk.no_kwt , fk.bayar, fk.tgl_kwt from dbfile.`01farm_kuitansi` fk 
        left join ranap.inap on ranap.inap.no_reg=fk.no_reg 
        where  fk.tgl_kwt >=ranap.inap.tgl_masuk  and fk.deleted is NULL and fk.rawat ='I'
        union all 
        select fk.no_reg , fk.no_kwt , fk.bayar, fk.tgl_kwt from dbfile.`06farm_kuitansi` fk 
        left join ranap.inap on ranap.inap.no_reg=fk.no_reg
        where  fk.tgl_kwt >=ranap.inap.tgl_masuk  and fk.deleted is NULL and fk.rawat ='I'
        union all 
        select fk.no_reg , fk.no_kwt , fk.bayar, fk.tgl_kwt from dbfile.`03farm_kuitansi` fk 
        left join ranap.inap on ranap.inap.no_reg=fk.no_reg
        where  fk.tgl_kwt >=ranap.inap.tgl_masuk and fk.deleted is NULL and fk.rawat ='I'
        union all
        select fk.no_reg , fk.no_kwt , fk.bayar, fk.tgl_kwt from dbfile.`02farm_kuitansi` fk 
        left join ranap.inap on ranap.inap.no_reg=fk.no_reg
        where  fk.tgl_kwt >=ranap.inap.tgl_masuk and fk.deleted is NULL 
        union all 
        select fk.no_reg , fk.no_kwt , fk.bayar, fk.tgl_kwt from dbfile.`05farm_kuitansi` fk 
        left join ranap.inap on ranap.inap.no_reg=fk.no_reg
        where  fk.tgl_kwt >=ranap.inap.tgl_masuk and fk.deleted is NULL 
        union all 
        select fk.no_reg , fk.no_kwt , fk.bayar, fk.tgl_kwt from dbfile.`08farm_kuitansi` fk 
        left join ranap.inap on ranap.inap.no_reg=fk.no_reg
        where  fk.tgl_kwt >=ranap.inap.tgl_masuk and fk.deleted is NULL 
        ) farm group by farm.no_reg)t1 on  ranap.inap.no_reg  = t1.no_reg               
        left join
        (select no_reg,tanggal,sum(jumlah) as jumlah from ( 
        select rd.no_reg , rd.no_perk , rd.tanggal, rd.jumlah  from bill.rmina_db5 rd 
        left join ranap.inap ri on ri.no_reg=rd.no_reg and ri.tgl_masuk=rd.tgl_masuk
        where  rd.tgl_masuk =ri.tgl_masuk and deleted is null
        union all
        select rd.no_reg , rd.no_perk , rd.tanggal, rd.jumlah from bill.rarofah_db5 rd 
        left join ranap.inap ri on ri.no_reg=rd.no_reg and ri.tgl_masuk=rd.tgl_masuk
        where  rd.tgl_masuk =ri.tgl_masuk and deleted is null
        union all
        select rd.no_reg , rd.no_perk , rd.tanggal, rd.jumlah from bill.ricu_db5 rd 
        left join ranap.inap ri on ri.no_reg=rd.no_reg and ri.tgl_masuk=rd.tgl_masuk
        where  rd.tgl_masuk =ri.tgl_masuk and deleted is null
        union all
        select rd.no_reg , rd.no_perk , rd.tanggal, rd.jumlah from bill.risolasi_db5 rd 
        left join ranap.inap ri on ri.no_reg=rd.no_reg and ri.tgl_masuk=rd.tgl_masuk
        where  rd.tgl_masuk =ri.tgl_masuk and deleted is null
        union all
        select rd.no_reg , rd.no_perk , rd.tanggal, rd.jumlah from bill.rmarwah_db5 rd 
          left join ranap.inap ri on ri.no_reg=rd.no_reg and ri.tgl_masuk=rd.tgl_masuk
        where  rd.tgl_masuk =ri.tgl_masuk and deleted is null
        union all
        select rd.no_reg , rd.no_perk , rd.tanggal, rd.jumlah from bill.rshofa_db5 rd 
           left join ranap.inap ri on ri.no_reg=rd.no_reg and ri.tgl_masuk=rd.tgl_masuk
        where  rd.tgl_masuk =ri.tgl_masuk and deleted is null
        union all
        select rd.no_reg , rd.no_perk , rd.tanggal, rd.jumlah from bill.rzam_db5 rd 
         left join ranap.inap ri on ri.no_reg=rd.no_reg and ri.tgl_masuk=rd.tgl_masuk
        where  rd.tgl_masuk =ri.tgl_masuk and deleted is null
        union all
        select rd.no_reg , rd.no_perk , rd.tanggal, rd.jumlah from bill.rzam2_db5 rd 
          left join ranap.inap ri on ri.no_reg=rd.no_reg and ri.tgl_masuk=rd.tgl_masuk
        where  rd.tgl_masuk =ri.tgl_masuk and deleted is null
        union all
        select rd.no_reg , rd.no_perk , rd.tanggal, rd.jumlah from bill.rsiti_h_db5 rd 
        left join ranap.inap ri on ri.no_reg=rd.no_reg and ri.tgl_masuk=rd.tgl_masuk
        where  rd.tgl_masuk =ri.tgl_masuk and deleted is null
        union all
        select rd.no_reg , rd.no_perk , rd.tanggal, rd.jumlah from bill.rvk_db5 rd 
        left join ranap.inap ri on ri.no_reg=rd.no_reg and ri.tgl_masuk=rd.tgl_masuk
        where  rd.tgl_masuk =ri.tgl_masuk and deleted is null
           union all
        select rd.no_reg , rd.no_perk , rd.tanggal, rd.jumlah from bill.rpicu_db5 rd 
        left join ranap.inap ri on ri.no_reg=rd.no_reg and ri.tgl_masuk=rd.tgl_masuk
        where  rd.tgl_masuk =ri.tgl_masuk and deleted is null
        union all
        select rd.no_reg , rd.no_perk , rd.tanggal, rd.jumlah from bill.rjblnur_db5 rd
           left join ranap.inap ri on ri.no_reg=rd.no_reg and ri.tgl_masuk=rd.tgl_masuk
        where  rd.tgl_masuk =ri.tgl_masuk and deleted is null
        ) bgs group by bgs.no_reg) t2
        on ranap.inap.no_reg = t2.no_reg
        left join (
        select ldi.no_reg , ldi.tanggal , sum(ldi.jumlah) as jumlah  from bill.lab_db5i ldi 
        left join ranap.inap ri on ri.no_reg=ldi.no_reg 
        where  jumlah>0 and deleted is null and ldi.tanggal >=ri.tgl_masuk
        group by ldi.no_reg
        ) t3 on ranap.inap.no_reg =t3.no_reg
        left join (
        select ldi.no_reg , ldi.tanggal ,sum(ldi.jumlah) as jumlah  from bill.ro_db5i ldi 
        left join ranap.inap ri on ri.no_reg=ldi.no_reg 
        where deleted is null and  ldi.tanggal >=ri.tgl_masuk 
        group by ldi.no_reg,ldi.tanggal
        ) t4 on ranap.inap.no_reg =t4.no_reg 
        left join (
            select jd.no_reg , jd.tanggal , sum(jd.jumlah) as jumlah  from bill.jantung_db5 jd
            left join ranap.inap ri on ri.no_reg=jd.no_reg
            where jd.tanggal >=ri.tgl_masuk and deleted is null
            group by jd.no_reg
            ) t5 on ranap.inap.no_reg = t5.no_reg
            left join (
            select jd.no_reg , jd.tanggal , sum(jd.jumlah) as jumlah  from bill.sps_db5 jd  
            left join ranap.inap ri on ri.no_reg=jd.no_reg
            where jd.tanggal >=ri.tgl_masuk and deleted is null
            group by jd.no_reg
            ) t6 on ranap.inap.no_reg = t6.no_reg
            left join (
            select jd.no_reg , jd.tanggal , sum(jd.jumlah) as jumlah  from bill.gigi_db5 jd  
             left join ranap.inap ri on ri.no_reg=jd.no_reg
            where jd.tanggal >=ri.tgl_masuk and deleted is null
            group by jd.no_reg
            ) t7 on ranap.inap.no_reg = t7.no_reg
            left join (
            select jd.no_reg , jd.tanggal , sum(jd.jumlah) as jumlah  from bill.rhmed_db5  jd  
            left join ranap.inap ri on ri.no_reg=jd.no_reg
            where jd.tanggal >=ri.tgl_masuk and deleted is null
            group by jd.no_reg
            ) t8 on ranap.inap.no_reg = t8.no_reg
            left join (
            select jd.no_reg , jd.tanggal , sum(jd.jumlah) as jumlah  from bill.eeg_db5 jd  
            left join ranap.inap ri on ri.no_reg=jd.no_reg
            where jd.tanggal >=ri.tgl_masuk and deleted is null
            group by jd.no_reg
            ) t9 on ranap.inap.no_reg = t9.no_reg
            left join (
            select jd.no_reg , jd.tanggal , sum(jd.jumlah) as jumlah  from bill.ugd_db5 jd  
            left join ranap.inap ri on ri.no_reg=jd.no_reg
            where jd.tanggal >=ri.tgl_masuk and deleted is null
            group by jd.no_reg
            ) t10 on ranap.inap.no_reg = t10.no_reg
        ) tarif on tarif.no_reg = a.no_reg 
        left join 
        (select * from inacbg.t_gruper where deleted ='0') tg on tg.no_reg= a.no_reg and tg.tgl_ri = a.tgl_ri
        WHERE      
        a.kd_asuransi IN ('300','301','302','303','304','305','306')
        and left(a.kd_bangsal,3) = '$rawat'
        GROUP BY a.no_reg,a.tgl_masuk    
        "; 
    }

        // ipclient()==IPC?die($query):'';
        $soap = DB::select($query);
        // pre($soap);
        $str_tgl_dirawat = "";
        $total_tjp = 0;
        if (!empty($soap)) {
            $no = 1; 
            
            foreach ($soap as $row) {
                $row = (object) $row; 
                $row->id        = $row->id;
                $row->no        = $no;
                $row->tanggal   = date('d-m-Y', strtotime($row->tgl_masuk));
                // $row->tanggal   = $row->tgl_keluar;
                $row->nama      = strtoupper($row->nama);
                $row->no_reg    = $row->no_reg;
                $row->umur    = $row->umur;
                $row->tgl_masuk = $row->tgl_masuk;
                $row->jam_masuk = $row->jam_masuk;
                $row->nama_dr   = $row->nama_dr;
                $row->nama_poli = $row->nama_poli;
              

                // $row->jumlah    = number_format($rowx->jumlahx, 2, '.', ',');
                $row->asuransi_id    = $row->asuransi_id;
                $row->gruper = $row->gruper;
//tarif e anyar
$query2 ="
SELECT no_reg,sum(jumlah) as jumlah,tanggal from (select t.no_reg,sum(t.jumlah) as jumlah,t.tanggal from billing.transaksi t where t.deleted ='0' and tanggal >= '$row->tgl_masuk' and no_reg='$row->no_reg' group by t.no_reg
union all
select it.no_reg, sum(it.total_semua) as jumlah , it.tanggal from billing.ibs_transaksi it where it.deleted ='0' and tanggal >= '$row->tgl_masuk' and no_reg='$row->no_reg' group by it.no_reg
union all
select tr.no_reg, sum(tr.jumlah) as jumlah, tr.tanggal from billing.transaksi_rsik tr where tr.deleted ='0' and tanggal >= '$row->tgl_masuk' and no_reg='$row->no_reg' group by tr.no_reg
union all
select rj.no_rm as no_reg, sum(rj.subtotal) as jumlah, rj.tanggal  from billing.apotek rj where rj.deleted='0' and rj.no_rm ='$row->no_reg' and rj.tanggal>='$row->tgl_masuk'  group by rj.no_rm
union all
select rj.no_rm as no_reg, sum(rj.subtotal) as jumlah, rj.tanggal  from billing.apotek_ri rj where rj.deleted='0' and rj.no_rm ='$row->no_reg' and rj.tanggal>='$row->tgl_masuk'  group by rj.no_rm	
union all
select rj.no_rm as no_reg, sum(rj.subtotal) as jumlah, rj.tanggal  from billing.apotek_ugd rj  where rj.deleted='0' and rj.no_rm ='$row->no_reg' and rj.tanggal>='$row->tgl_masuk'  group by rj.no_rm
union all
select rj.no_rm as no_reg, sum(rj.subtotal) as jumlah, rj.tanggal  from billing.apotek_ibs rj where rj.deleted='0' and rj.no_rm ='$row->no_reg' and rj.tanggal>='$row->tgl_masuk'  group by rj.no_rm

) tran 
where tanggal >= '$row->tgl_masuk' and no_reg='$row->no_reg'
";
$tarifan = DB::connection('billing_byl')->select($query2);
foreach ($tarifan as $rowx) {
    $rowx = (object) $rowx; 
    $rowx->jumlahx = $rowx->jumlah;
    // $total_duite += $rowx->jumlahx;
}
// pre($rowx->jumlahx);
                $row->jumlah    = number_format($rowx->jumlah, 0, '.', ',');
                $row->tr_grouper    = number_format($row->tr_grouper, 0, '.', ',');
                $row->icd1 = $row->icd1;
                // var_dump($row);die;
                // $query3 ="Select * from keuangan.anti_fraud where koding='$row->icd1'";
                // $kodingan = DB::connection('billing_byl')->select($query3);
                // foreach($kodingan as $ba){
                //     $ba = (object) $ba;
                //     $ba->aspek_koding = $ba->aspek_koding; 
                //     $ba->perhatian_khusus = $ba->perhatian_khusus; 
                // }
   
          

                // pre($ba->aspek_koding = $ba->aspek_koding);
          
 
                switch ($row->asuransi_id){
                  case '300':
                  case '301':
                  case '302':
                  case '303':
                  case '304':
                  $rel = "BPJS";
                  break;
                  case '001';
                  $rel ="UMUM";
                  break;
                  default: 
                  $rel='ASKOM';
                }
                $row->asuransi_id=$rel;
                // if ($row->jenis == '1'){
                //     $jenis ='Baru';
                // }else {
                //     $jenis ='Lama';  
                // }
                // $row->jenis = $jenis;
                // $row->diagnosa  = $row->diagnosa;
                if (!empty($row->done)) {
                    $tombol = "<a class='btn btn-sm btn-success text-light fa fa-check-square-o' id='edit_icd' data-soap_id='$row->id' data-no_reg='$row->no_reg' data-nama='$row->nama' data-tgl_masuk='$row->tgl_masuk' data-jam_masuk='$row->jam_masuk'></a>";
                }else {
                    $tombol = "<a class='btn btn-sm btn-danger text-light fa fa-close' id='edit_icd' data-soap_id='$row->id' data-no_reg='$row->no_reg' data-nama='$row->nama' data-tgl_masuk='$row->tgl_masuk' data-jam_masuk='$row->jam_masuk'></a>";
                }
                $row->aksi = $tombol;
                $rows[] = $row;
                $no ++; 
            } 
            $total = count($rows);
        } else {
            $row = (object) null;  
            $rows[] = $row;
            $total = 0;
        }
        $tgl_msk = $row->tgl_masuk;
        // $query2 = "
        // select ranap.inap.no_reg,if(t1.jumlah is null,0,t1.jumlah) + if(t2.jumlah is null, 0,t2.jumlah)+if(t3.jumlah is null, 0,t3.jumlah)+if(t4.jumlah is null, 0,t4.jumlah) as jumlah, ranap.inap.tgl_masuk from ranap.inap
		// 	left join (select no_reg, sum(bayar) as jumlah from(
        //     select fk.no_reg , fk.no_kwt , fk.bayar, fk.tgl_kwt from dbfile.`01farm_kuitansi` fk where  fk.tgl_kwt >='$tgl_msk' and fk.deleted is NULL and fk.rawat ='I'
        //     union all 
        //     select fk.no_reg , fk.no_kwt , fk.bayar, fk.tgl_kwt from dbfile.`02farm_kuitansi` fk where  fk.tgl_kwt >='$tgl_msk' and fk.deleted is NULL 
        //     union all 
        //     select fk.no_reg , fk.no_kwt , fk.bayar, fk.tgl_kwt from dbfile.`05farm_kuitansi` fk where  fk.tgl_kwt >='$tgl_msk' and fk.deleted is NULL 
        //     union all 
        //     select fk.no_reg , fk.no_kwt , fk.bayar, fk.tgl_kwt from dbfile.`08farm_kuitansi` fk where  fk.tgl_kwt >='$tgl_msk' and fk.deleted is NULL 
        //     ) farm group by farm.no_reg)t1 on  ranap.inap.no_reg  = t1.no_reg
        //     left join
        //     (select no_reg,tanggal,sum(jumlah) as jumlah from ( 
        //     select rd.no_reg , rd.no_perk , rd.tanggal, rd.jumlah  from bill.rmina_db5 rd where  rd.tgl_masuk ='$tgl_msk'
        //     union all
        //     select rd.no_reg , rd.no_perk , rd.tanggal, rd.jumlah from bill.rarofah_db5 rd where  rd.tgl_masuk ='$tgl_msk'
        //     union all
        //     select rd.no_reg , rd.no_perk , rd.tanggal, rd.jumlah from bill.ricu_db5 rd where  rd.tgl_masuk ='$tgl_msk'
        //     union all
        //     select rd.no_reg , rd.no_perk , rd.tanggal, rd.jumlah from bill.risolasi_db5 rd where  rd.tgl_masuk ='$tgl_msk'
        //     union all
        //     select rd.no_reg , rd.no_perk , rd.tanggal, rd.jumlah from bill.rmarwah_db5 rd where  rd.tgl_masuk ='$tgl_msk'
        //     union all
        //     select rd.no_reg , rd.no_perk , rd.tanggal, rd.jumlah from bill.rshofa_db5 rd where  rd.tgl_masuk ='$tgl_msk'
        //     ) bgs group by bgs.no_reg) t2
        //     on ranap.inap.no_reg = t2.no_reg
        //     left join (
        //     select ldi.no_reg , ldi.tanggal , sum(ldi.jumlah) as jumlah  from bill.lab_db5i ldi where ldi.tgl_masuk ='$tgl_msk'
        //     group by ldi.no_reg
        //     ) t3 on ranap.inap.no_reg =t3.no_reg
        //     left join (
        //     select ldi.no_reg , ldi.tanggal , sum(ldi.jumlah) as jumlah  from bill.ro_db5i ldi where ldi.tgl_masuk ='$tgl_msk'
        //     group by ldi.no_reg
        //     ) t4 on ranap.inap.no_reg =t4.no_reg           
        //     "; 
 
        //  $rowx = (array) null ;
        //  $rowz = (array) null ;
        // $bill = DB::select($query2);
        // if (!empty($bill)) {
        //     $no = 1; 
            
        //     foreach ($bill as $rowx) {
        //         $rowx = (object) $rowx;
        //         $rowx -> no_reg = $rowx-> no_reg;
        //         $rowx->jumlah = $rowx->jumlah;
        //     }
        //     $rowz[] = $rowx;
        //     $no ++;
        // }
        // pre($rowz);
        // echo"<pre>";print_r($soap);die();

        $data = array(
            "rows"    => $rows,
            // "tarif_rs" => $rowz,
            // "ba" =>$ba,
            "total"   => $total,
            "grand_total"   => $total,
            "total_tjp"   => $total,
            "total_sep"   => $total,
            // 'inacbg' => $inacbg,
        );

        // pre($data);
        return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($data));
       