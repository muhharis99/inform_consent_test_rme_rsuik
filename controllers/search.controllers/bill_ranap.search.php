<?php 
        // $this->load->model('soap_inap');
        $this->load->model('inap');
        // $this->load->model('tarif_ibs');
        // $this->load->model('inacbgi');
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
        $rowy = (array) null; 
        $total = (int) 0;
        $total_duite = 0; 
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

        if (empty($rawat) || $rawat == 'all') {
            $query = "
            SELECT a.id,a.no_reg,a.nama,a.tgl_ri as tgl_masuk,a.jam_ri as jam_masuk,a.kelas,a.alamat,datediff(curdate(),a.tgl_ri) as los,a.kd_bangsal as bangsal_id ,a.dpjp1 ,a.kd_asuransi as asuransi_id ,FLOOR(datediff(a.tgl_masuk,a.tgl_lahir)/365) as umur,
       a.registered,
       b.nama2 as nama_dr,
       c.induk_nama as nama_poli, tarif.jumlah + if(isnull(tibs.jumlah),'0',tibs.jumlah) as jumlah,if(isnull(date(o.start)),'-','Ya') as operasi,if(isnull(date(o.start)),'-','Ya') as operasi,if(isnull(tibs.jumlah),'0','1') as flag_op,
       max(d.Id) as done
            FROM ranap.inap a      
            left join 
            (select * from inacbg.tarif_ibs where deleted is null) tibs on tibs.no_reg=a.no_reg and tibs.tgl_masuk = a.tgl_ri 
            left join rme.operasi o 
            on o.no_reg = a.no_reg and date(o.start) >= a.tgl_masuk 
            LEFT JOIN 
                rsiklaten.dokter b ON a.dpjp1 = b.no_dr
            LEFT JOIN
                rme.bangsal c ON a.kd_bangsal  = c.kd_bangsal
            LEFT JOIN
                inacbg.diag_ri d ON a.id = d.soap_id and d.deleted is null
            left join (
            select ranap.inap.no_reg,if(t1.jumlah is null,0,t1.jumlah)+ if(t2.jumlah is null, 0,t2.jumlah)+if(t3.jumlah is null, 0,t3.jumlah)+if(t4.jumlah is null, 0,t4.jumlah)+if(t5.jumlah is null, 0,t5.jumlah)+if(t6.jumlah is null, 0,t6.jumlah)
            +if(t7.jumlah is null, 0,t7.jumlah)+if(t8.jumlah is null, 0,t8.jumlah)+if(t9.jumlah is null, 0,t9.jumlah)+if(t10.jumlah is null, 0,t10.jumlah)+if(t11.jumlah is null, 0,t11.jumlah)
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
                left join (
                    select jd.no_reg , jd.tanggal , sum(jd.jumlah) as jumlah  from bill.hd_db5 jd  
                    left join ranap.inap ri on ri.no_reg=jd.no_reg
                    where jd.tanggal >=ri.tgl_masuk and deleted is null
                    group by jd.no_reg
                    ) t11 on ranap.inap.no_reg = t11.no_reg
            ) tarif on tarif.no_reg = a.no_reg 
            where a.no_reg not in ('0000001','0000002','0000003') and a.pulang <>'T'
            GROUP BY a.no_reg,a.tgl_masuk order by a.tgl_ri desc    
            "; 
            // if (ipclient()==IPC) pre($query); a.kd_asuransi IN ('300','301','302','303','304','305','306')
        }else if ($rawat == 'KBR'){
            $query = "
            SELECT a.id,a.no_reg,a.nama,a.tgl_masuk,a.jam_masuk,a.kelas,a.alamat,datediff(curdate(),a.tgl_ri) as los,a.kd_bangsal as bangsal_id ,a.dpjp1 ,a.kd_asuransi as asuransi_id ,FLOOR(datediff(a.tgl_masuk,a.tgl_lahir)/365) as umur,
       a.registered,
       b.nama2 as nama_dr,
       c.induk_nama as nama_poli,tarif.jumlah + if(isnull(tarif_ibs.jumlah),'0',tarif_ibs.jumlah) as jumlah,if(isnull(date(o.start)),'-','Ya') as operasi,if(isnull(date(o.start)),'-','Ya') as operasi,if(isnull(tarif_ibs.jumlah),'0','1') as flag_op,
       max(d.Id) as done
            FROM ranap.inap a
            left join 
            inacbg.tarif_ibs on tarif_ibs.no_reg=a.no_reg and tarif_ibs.tgl_masuk = a.tgl_ri  
            left join rme.operasi o 
            on o.no_reg = a.no_reg and date(o.start) >= a.tgl_masuk 
            LEFT JOIN 
                rsiklaten.dokter b ON a.dpjp1 = b.no_dr
            LEFT JOIN
                rme.bangsal c ON a.kd_bangsal = c.kd_bangsal 
            LEFT JOIN
                inacbg.diag_ri d ON a.id = d.soap_id and d.deleted is null
            left join (
            select ranap.inap.no_reg,if(t1.jumlah is null,0,t1.jumlah)+ if(t2.jumlah is null, 0,t2.jumlah)+if(t3.jumlah is null, 0,t3.jumlah)+if(t4.jumlah is null, 0,t4.jumlah)+if(t5.jumlah is null, 0,t5.jumlah)+if(t6.jumlah is null, 0,t6.jumlah)
            +if(t7.jumlah is null, 0,t7.jumlah)+if(t8.jumlah is null, 0,t8.jumlah)+if(t9.jumlah is null, 0,t9.jumlah)+if(t10.jumlah is null, 0,t10.jumlah)+if(t11.jumlah is null, 0,t11.jumlah)
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
                left join (
                    select jd.no_reg , jd.tanggal , sum(jd.jumlah) as jumlah  from bill.hd_db5 jd  
                    left join ranap.inap ri on ri.no_reg=jd.no_reg
                    where jd.tanggal >=ri.tgl_masuk and deleted is null
                    group by jd.no_reg
                    ) t11 on ranap.inap.no_reg = t11.no_reg
            ) tarif on tarif.no_reg = a.no_reg 
            WHERE      
            a.kd_bangsal like 'PI%' or a.kd_bangsal like 'NC%'
            GROUP BY a.no_reg,a.tgl_masuk order by a.tgl_ri desc    
            "; 
        }else {
            $query = "
            SELECT a.id,a.no_reg,a.nama,a.tgl_masuk,a.jam_masuk,a.kelas,a.alamat,datediff(curdate(),a.tgl_ri) as los,a.kd_bangsal as bangsal_id ,a.dpjp1 ,a.kd_asuransi as asuransi_id ,FLOOR(datediff(a.tgl_masuk,a.tgl_lahir)/365) as umur,
       a.registered,
       b.nama2 as nama_dr,
       c.induk_nama as nama_poli,tarif.jumlah + if(isnull(tarif_ibs.jumlah),'0',tarif_ibs.jumlah) as jumlah,if(isnull(date(o.start)),'-','Ya') as operasi,if(isnull(tarif_ibs.jumlah),'0','1') as flag_op,
       max(d.Id) as done
            FROM ranap.inap a
            left join 
            inacbg.tarif_ibs on tarif_ibs.no_reg=a.no_reg and tarif_ibs.tgl_masuk = a.tgl_ri   
            left join rme.operasi o 
            on o.no_reg = a.no_reg and date(o.start) >= a.tgl_masuk 
            LEFT JOIN 
                rsiklaten.dokter b ON a.dpjp1 = b.no_dr
            LEFT JOIN
                rme.bangsal c ON a.kd_bangsal = c.kd_bangsal 
            LEFT JOIN
                inacbg.diag_ri d ON a.id = d.soap_id and d.deleted is null
            left join (
            select ranap.inap.no_reg,if(t1.jumlah is null,0,t1.jumlah)+ if(t2.jumlah is null, 0,t2.jumlah)+if(t3.jumlah is null, 0,t3.jumlah)+if(t4.jumlah is null, 0,t4.jumlah)+if(t5.jumlah is null, 0,t5.jumlah)+if(t6.jumlah is null, 0,t6.jumlah)
            +if(t7.jumlah is null, 0,t7.jumlah)+if(t8.jumlah is null, 0,t8.jumlah)+if(t9.jumlah is null, 0,t9.jumlah)+if(t10.jumlah is null, 0,t10.jumlah)+if(t11.jumlah is null, 0,t11.jumlah)
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
                left join (
                    select jd.no_reg , jd.tanggal , sum(jd.jumlah) as jumlah  from bill.hd_db5 jd  
                    left join ranap.inap ri on ri.no_reg=jd.no_reg
                    where jd.tanggal >=ri.tgl_masuk and deleted is null
                    group by jd.no_reg
                    ) t11 on ranap.inap.no_reg = t11.no_reg
            ) tarif on tarif.no_reg = a.no_reg 
            WHERE      
            left(a.kd_bangsal,3) = '$rawat' and a.pulang <>'T'
            GROUP BY a.no_reg,a.tgl_masuk order by a.tgl_ri desc    
            "; 
        }


        // pre($rawat);  a.kd_asuransi IN ('300','301','302','303','304','305','306')
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
// pre($row->no_reg);
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
    $total_duite += $rowx->jumlahx;
}

$query3="
SELECT no_rm,no_transaksi,date(date_bayar) as tanggal from billing.kasir_payment_inap kp where kp.deleted ='0' and date(kp.date_bayar) >= '$row->tgl_masuk' group by kp.no_rm";
$lunasan = DB::connection('billing_byl')->select($query3);

$row->lunas = 'Belum'; 

if (!empty($lunasan)) {
    foreach ($lunasan as $rowy) {
        if (!empty($rowy->no_transaksi)) {
            $rowy->no_tran = $rowy->no_transaksi;
            $row->lunas = 'Lunas';
            break; // cukup satu saja untuk tandai lunas
        }
    }
}
// pre($rowy->no_tran);

                $row->asuransi_id    = $row->asuransi_id;
                $row->jumlah    = number_format($rowx->jumlahx, 0, '.', ',');
                $row->operasi = $row->operasi; 
                $row->los = $row->los;      
                $row->lunas = $row->lunas;
                switch ($row->asuransi_id){
                  case '300':
                  case '301':
                  case '302':
                  case '304':
                  $rel = "BPJS";
                  break;
                  case '303':
                    $rel = "BPJS KRYA";
                  case '001';
                  $rel ="UMUM";
                  break;
                  case '254';
                  $rel ="J.R";
                  break;
                  default: 
                  $rel='ASKOM';
                }
                $row->asuransi_id=$rel;
                // $row->flag_op = $row->flag_op; 
                //  if ($row->flag_op == '1') {
                //     $tombol = "<a class='btn btn-sm btn-success text-light fa fa-check-square-o'></a>";
                // }else {
                //     $tombol = "<a class='btn btn-sm btn-danger text-light fa fa-close'></a>";
                // }
                  $row->tombol = '-';
                // if ($row->jenis == '1'){
                //     $jenis ='Baru';
                // }else {
                //     $jenis ='Lama';  
                // }
                // $row->jenis = $jenis;
                // $row->diagnosa  = $row->diagnosa;
                // if (!empty($row->done)) {
                //     $tombol = "<a class='btn btn-sm btn-success text-light fa fa-check-square-o' id='edit_icd' data-soap_id='$row->id' data-no_reg='$row->no_reg' data-nama='$row->nama' data-tgl_masuk='$row->tgl_masuk' data-jam_masuk='$row->jam_masuk'></a>";
                // }else {
                //     $tombol = "<a class='btn btn-sm btn-danger text-light fa fa-close' id='edit_icd' data-soap_id='$row->id' data-no_reg='$row->no_reg' data-nama='$row->nama' data-tgl_masuk='$row->tgl_masuk' data-jam_masuk='$row->jam_masuk'></a>";
                // }
                // $row->aksi = $tombol;
                $rows[] = $row;
                $no ++; 
            } 
            $total = count($rows);
            // $total_duite += $rows->jumlah;
            // pre($total_duite);
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
            "total"   => $total,
            "grand_total"   => $total,
            "total_duite" => number_format($total_duite, 0, '.', ','),
            "total_tjp"   => $total,
            "total_sep"   => $total,
            // 'tombol' => $tombol,
        );

        // pre($data);
        return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($data));
       