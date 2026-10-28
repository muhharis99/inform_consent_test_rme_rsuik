
<style>
    .modal.left .modal-dialog,
	.modal.right .modal-dialog {
		position: fixed;
		margin: auto;
		width: 600px;
		height: 100%;
		-webkit-transform: translate3d(0%, 0, 0);
		    -ms-transform: translate3d(0%, 0, 0);
		     -o-transform: translate3d(0%, 0, 0);
		        transform: translate3d(0%, 0, 0);
	}

	.modal.left .modal-content,
	.modal.right .modal-content {
		height: 100%;
		overflow-y: auto;
	}
	
	.modal.left .modal-body,
	.modal.right .modal-body {
		padding: 15px 15px 80px;
	}

    /*Left*/
	.modal.left.fade .modal-dialog{
		left: -320px;
		-webkit-transition: opacity 0.3s linear, left 0.3s ease-out;
		   -moz-transition: opacity 0.3s linear, left 0.3s ease-out;
		     -o-transition: opacity 0.3s linear, left 0.3s ease-out;
		        transition: opacity 0.3s linear, left 0.3s ease-out;
	}
	
	.modal.left.fade.in .modal-dialog{
		left: 0;
	}
        
    /*Right*/
	.modal.right.fade .modal-dialog {
		right: -320px;
		-webkit-transition: opacity 0.3s linear, right 0.3s ease-out;
		   -moz-transition: opacity 0.3s linear, right 0.3s ease-out;
		     -o-transition: opacity 0.3s linear, right 0.3s ease-out;
		        transition: opacity 0.3s linear, right 0.3s ease-out;
	}
	
	.modal.right.fade.in .modal-dialog {
		right: 0;
	}

    /* ----- MODAL STYLE ----- */
    .modal-content {
        border-radius: 0;
        border: none;
    }

    .modal-header {
        border-bottom-color: #EEEEEE;
        background-color: #FAFAFA;
    }

    /* ----- v CAN BE DELETED v ----- */
    xbody {
        background-color: #78909C;
    }

    .demo {
        padding-top: 60px;
        padding-bottom: 110px;
    }

    .btn-demo {
        margin: 15px;
        padding: 10px 15px;
        border-radius: 0;
        font-size: 16px;
        background-color: #FFFFFF;
    }

    .btn-demo:focus {
        outline: 0;
    }

    .demo-footer {
        position: fixed;
        bottom: 0;
        width: 100%;
        padding: 15px;
        background-color: #212121;
        text-align: center;
    }

    .demo-footer > a {
        text-decoration: none;
        font-weight: bold;
        font-size: 16px;
        color: #fff;
    }
    #logout {
        display:none !important;
    }
    #title-preview {
        cursor:pointer !important;
    }
</style>
<div class="row">
    <div class="col-md-12 col-xs-12 col-sm-12" style="padding:0px !important;">
        <h2 class="row-centered col-md-12">
            <i class="fa fa-print" aria-hidden="true"></i> &nbsp;CETAK DOKUMEN ELEKTRONIK PASIEN RAWAT INAP
        </h2>
        <div class="text-right col-md-12 hide">
            <span id="user">{{ $akses }}</span>
        </div>
        <div class="col-md-4" style="padding-left:5px !important; padding-right:7px !important;">
            <div class="row">
                <div class="col-md-12 col-xs-12 col-sm-12">
                    <form class="form-horizontal" id="haslab" method="post" name="haslab">
                        <!-- id will be unique, but class name will be same -->
                        <h4 class="alert alert-success">
                            <i class="fa fa-user"></i> &nbsp;PASIEN
                        </h4>
                        <div class="frm form-group" id="sf1">
                            <!--  user name field will be here with next button -->
                            <fieldset>
                                <div class="">
                                    <label class="control-label col-md-3" for="no_reg">
                                        No RM :
                                    </label>
                                    <div class="col-md-9 no_reg_spinner">
                                        <input autocomplete="off" class="form-control has-spinner" data-original-title="" id="no_reg" maxlength="7" name="no_reg" required="" title="" type="text" value="">
                                        </input>
                                    </div>
                                </div>
                                <div class="">
                                    <label class="control-label col-md-3" for="nama">
                                        Nama :
                                    </label>
                                    <div class="col-md-9">
                                        <input autocomplete="off" class="form-control" data-original-title="" id="nama" name="nama" readonly="" required="" title="" type="text" value="">
                                        </input>
                                    </div>
                                </div>
                                <div class="">
                                    <label class="control-label col-md-3" for="alamat">
                                        Alamat :
                                    </label>
                                    <div class="col-md-9">
                                        <input autocomplete="off" class="form-control" data-original-title="" id="alamat" name="alamat" readonly="" required="" title="" type="text" value="">
                                        </input>
                                    </div>
                                </div>
                                <div class="">
                                    <label class="control-label col-md-3" for="tgl_lahir">
                                        Tgl Lahir :
                                    </label>
                                    <div class="col-md-9">
                                        <input autocomplete="off" class="form-control" data-original-title="" id="tgl_lahir" name="tgl_lahir" readonly="" required="" title="" type="text" value="">
                                        </input>
                                        <input class="form-control" data-original-title="" id="tgl_rs" name="tgl_rs" readonly="" required="" title="" type="hidden" value="">
                                        <input class="form-control" data-original-title="" id="tgl_kunjung" name="tgl_kunjung" readonly="" required="" title="" type="hidden" value="">
                                        <input class="form-control" data-original-title="" id="str_tgl_rs" name="str_tgl_rs" readonly="" required="" title="" type="hidden" value="">
                                        <input class="form-control" data-original-title="" id="dokumen" name="dokumen" readonly="" required="" title="" type="hidden" value="">
                                        </input>
                                        
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row" style="padding-bottom:50px;">
                
            </div>
        </div>
        <style>
        .col-hide {
            display:none;
            visibility:hidden;
            }
        </style>
        <div class="col-md-8 form-horizontal thumbnail-group" id="hasil" style="padding-right:5px !important; padding-left:0px !important;">
            <div class="form-horizontal" id="sf1">
                <div class="col-md-12 col-xs-12 col-sm-12">
                    <div class="form-horizontal" id="sf1">
                        <!--  user name field will be here with next button -->
                        <h4 class="alert alert-success">
                            <i class="fa fa-folder-open-o"></i> &nbsp;DOKUMEN
                        </h4>

                        <style>
                        .a-left a.btn {
                            text-align:left !important;
                            text-decoration:underline;
                            border-bottom-width:0px;
                            border-width:0px;
                            }
                        a.btn i {
                            margin-right:5px;
                        }
                        </style>
                        <div class="a-left">
                            <a class="btn btn-default col-md-12 col-xs-12" href="#" id="data_sosial" title="">
                                <i class="fa fa-newspaper-o"></i> FM/RM/01 - Data Sosial Pasien Rawat Inap
                            </a>
                            <a class="btn btn-default col-md-12 col-xs-12" href="#" id="resume_medis" title="">
                                <i class="fa fa-newspaper-o"></i> FM/RM/02 - Resume Medis Rawat Inap
                            </a>
                            <!--
                            <a class="btn btn-default col-md-12 col-xs-12" href="#" id="resume_medis" title="">
                                <i class="fa fa-newspaper-o"></i> FM/RM/02 - Resume Medis
                            </a>
                            -->
                            <a class="btn btn-default col-md-12 col-xs-12" href="#" id="resume_keperawatan_ringkasan_pasien_pulang" title="">
                                <i class="fa fa-newspaper-o"></i> FM/RM/03 - Resume Keperawatan (Ringkasan Pasien Pulang)
                            </a>
                            <a class="btn btn-default col-md-12 col-xs-12" href="#" id="triase" title="">
                                <i class="fa fa-newspaper-o"></i> FM/RM/04 - Triase GD
                            </a>
                            <a class="btn btn-default col-md-12 col-xs-12" href="#" id="asesmen_awal_igd" title="">
                                <i class="fa fa-newspaper-o"></i> FM/RM/04.1 - Asesmen Keperawatan GD
                            </a>
                            <a class="btn btn-default col-md-12 col-xs-12" href="#" id="soap_gd" title="">
                                <i class="fa fa-newspaper-o"></i> FM/RM/04.2 - Asesmen Medis GD
                            </a>
                            <a class="btn btn-default col-md-12 col-xs-12" href="#" id="pengkajian_dan_intervensi_resiko_jatuh_pasien_anak_hp" title="">
                                <i class="fa fa-newspaper-o"></i> FM/RM/04.3 - Pengkajian dan Intervensi Resiko Jatuh Pasien Anak
                            </a>
                            <a class="btn btn-default col-md-12 col-xs-12" href="#" id="pengkajian_dan_intervensi_resiko_jatuh_pada_pasien_neonotus" title="">
                                <i class="fa fa-newspaper-o"></i> FM/RM/04.5 - Pengkajian Resiko Jatuh Pasien Neonatus
                            </a>
                            <a class="btn btn-default col-md-12 col-xs-12" href="#" id="pengkajian_risiko_jatuh_pasien_geriatri" title="">
                                <i class="fa fa-newspaper-o"></i> FM/RM/04.6 - Pengkajian Resiko Jatuh Pasien Geriatri
                            </a>
                            <a class="btn btn-default col-md-12 col-xs-12" href="#" id="screening_covid" title="">
                                <i class="fa fa-newspaper-o"></i> FM/RM/04.7.3 - Skrining Awal & Lanjutan Covid-19
                            </a>
                            <a class="btn btn-default col-md-12 col-xs-12" href="#" id="asesmen_belajar" title="">
                                <i class="fa fa-newspaper-o"></i> FM/RM/16.1 - Asesmen Kemampuan dan Kemauan Belajar
                            </a>
                            <a class="btn btn-default col-md-12 col-xs-12" href="#" id="pemberian_informasi_pelayanan_rawat_inap" title="">
                                <i class="fa fa-newspaper-o"></i> FM/RM/16.2 - Pemberian Informasi Pelayanan & Persetujuan Ranap
                            </a>
                            <a class="btn btn-default col-md-12 col-xs-12" href="#" id="general_consent" title="">
                                <i class="fa fa-newspaper-o"></i> FM/RM/16.3 - Persetujuan Umum/General Consent
                            </a>
                            <a class="btn btn-default col-md-12 col-xs-12" href="#" id="akad_ijarah_umum" title="">
                                <i class="fa fa-credit-card"></i> Akad Ijarah Umum
                            </a>
                            <a class="btn btn-default col-md-12 col-xs-12" href="#" id="akad_ijarah_asuransi" title="">
                                <i class="fa fa-credit-card"></i> Akad Ijarah Asuransi
                            </a>
                            <a class="btn btn-default col-md-12 col-xs-12" href="#" id="akad_ijarah_bpjs_naik_kelas_vip" title="">
                                <i class="fa fa-credit-card"></i> Akad Ijarah BPJS Naik Kelas VIP
                            </a>
                            <a class="btn btn-default col-md-12 col-xs-12" href="#" id="akad_ijarah_bpjs_naik_kelas_i" title="">
                                <i class="fa fa-credit-card"></i> Akad Ijarah BPJS Naik Kelas I
                            </a>
                            <a class="btn btn-default col-md-12 col-xs-12" href="#" id="akad_ijarah_bpjs_naik_kelas_ii" title="">
                                <i class="fa fa-credit-card"></i> Akad Ijarah BPJS Naik Kelas II
                            </a>
                            <a class="btn btn-default col-md-12 col-xs-12" href="#" id="akad_ijarah_bpjs_mutasi_kelas" title="">
                                <i class="fa fa-credit-card"></i> Akad Ijarah BPJS Mutasi Naik Kelas
                            </a>
                            <a class="btn btn-default col-md-12 col-xs-12" href="#" id="sdp" title="">
                                <i class="fa fa-credit-card"></i> Status Debitur Pasien SDP
                            </a>
                            <a class="btn btn-default col-md-12 col-xs-12" href="#" id="transfer_internal" title="">
                                <i class="fa fa-newspaper-o"></i> FM/RM/05 - Transfer Internal
                            </a>
                            <!--
                            <a class="btn btn-default col-md-12 col-xs-12" href="#" id="ringkasan_pulang" title="">
                                <i class="fa fa-newspaper-o"></i> Ringkasan Pulang
                            </a>
                            -->
                            <a class="btn btn-default col-md-12 col-xs-12" href="#" id="asesmen_awal_medis_bedah_rawat_inap" title="">
                                <i class="fa fa-newspaper-o"></i> FM/RM/06.1.1 - Asesmen Awal Medis Bedah Rawat Inap
                            </a>
                            <a class="btn btn-default col-md-12 col-xs-12" href="#" id="asesmen_awal_medis_jantung_rawat_inap" title="">
                                <i class="fa fa-newspaper-o"></i> FM/RM/06.1.2 - Asesmen Awal Medis Jantung dan KardioVaskuler Rawat Inap
                            </a>
                            <a class="btn btn-default col-md-12 col-xs-12" href="#" id="asesmen_awal_medis_interna_rawat_inap" title="">
                                <i class="fa fa-newspaper-o"></i> FM/RM/06.1.11 - Asesmen Awal Medis Interna Rawat Inap
                            </a>
                            <a class="btn btn-default col-md-12 col-xs-12" href="#" id="catatan_perkembangan_pasien_terintegrasi" title="">
                                <i class="fa fa-newspaper-o"></i> FM/RM/06.2 - Catatan Perkembangan Pasien Terintegrasi
                            </a>
                            <a class="btn btn-default col-md-12 col-xs-12" href="#" id="pencatatan_dpjp" title="">
                                <i class="fa fa-newspaper-o"></i> FM/RM/06.2.1 - Pencatatan DPJP
                            </a>
                            <a class="btn btn-default col-md-12 col-xs-12" href="#" id="analisa_keperawatan" title="">
                                <i class="fa fa-newspaper-o"></i> FM/RM/08 - Analisa Data Keperawatan
                            </a>
                            <a class="btn btn-default col-md-12 col-xs-12" href="#" id="implementasi_keperawatan" title="">
                                <i class="fa fa-newspaper-o"></i> FM/RM/10.1.1 - Implementasi Keperawatan
                            </a>
                            <a class="btn btn-default col-md-12 col-xs-12" href="#" id="evaluasi_perkembangan_pasien" title="">
                                <i class="fa fa-newspaper-o"></i> FM/RM/10.1.2 - Evaluasi Perkembangan Pasien
                            </a>
                            <a class="btn btn-default col-md-12 col-xs-12" href="#" id="catatan_observasi_khusus_intervensi_dan_pengkajian_ulang_nyeri" title="">
                                <i class="fa fa-newspaper-o"></i> FM/RM/10.2 -Pencatatan Observasi Khusus, Intervensi dan Pengkajian Ulang Nyeri
                            </a>
                            <a class="btn btn-default col-md-12 col-xs-12" href="#" id="catatan_balance_cairan" title="">
                                <i class="fa fa-newspaper-o"></i> FM/RM/11 - Catatan Balance Cairan
                            </a>
                            <a class="btn btn-default col-md-12 col-xs-12" href="#" id="pemberian_informasi_tindakan_kedokteran_operasi" title="">
                                <i class="fa fa-newspaper-o"></i> FM/RM/21 - Pemberian Informasi Tindakan Kedokteran
                            </a>
                            <a class="btn btn-default col-md-12 col-xs-12" href="#" id="rekonsiliasi_obat" title="">
                                <i class="fa fa-newspaper-o"></i> FM/RM/12.1.3 - Rekonsiliasi Obat
                            </a>
                            <a class="btn btn-default col-md-12 col-xs-12" href="#" id="informasi_obat_pulang" title="">
                                <i class="fa fa-newspaper-o"></i> Form Informasi Obat Pulang
                            </a>
                            <a class="btn btn-default col-md-12 col-xs-12" href="#" id="hasil_pemeriksaan_penunjang_lab_dan_rd" title="">
                                <i class="fa fa-newspaper-o"></i> FM/RM/17 - Hasil Pemeriksaan Penunjang (Laboratorium dan Radio Diagnosik)
                            </a>
                            <a class="btn btn-default col-md-12 col-xs-12" href="#" id="asesmen_ulang_spiritual" title="">
                                <i class="fa fa-newspaper-o"></i> FM/RM/40 - Asesmen Ulang Spiritual
                            </a>
                            <a class="btn btn-default col-md-12 col-xs-12" href="#" id="catatan_perkembangan_pasien_terintegrasi" title="">
                                <i class="fa fa-newspaper-o"></i> FM/RM/40.1 - Pencatatan Observasi Khusus, Intervensi dan Pengkj. Ul
                            </a>
                            <a class="btn btn-default col-md-12 col-xs-12" href="#" id="pemberian_informasi_tindakan_regional_anestesi" title="">
                                <i class="fa fa-newspaper-o"></i> FM/RM/21.2 Pemberian Informasi Tindakan Regional Anestesi
                            </a>
                            <a class="btn btn-default col-md-12 col-xs-12" href="#" id="persetujuan_tindakan_kedokteran" title="">
                                <i class="fa fa-newspaper-o"></i> FM/RM/22 Persetujuan Tindakan Kedokteran
                            </a>
                            <a class="btn btn-default col-md-12 col-xs-12" href="#" id="checklist_keselamatan_operasi" title="">
                                <i class="fa fa-newspaper-o"></i> FM/RM/23 Checklist Keselamatan Operasi
                            </a>
                        </div>
                    </div>
                </div>
                <!--  user name field will be here with next button -->
                <!--
                <h4 class="alert alert-success" id="title-preview" data-toggle="modal" data-target="#myModal2">
                    <i class="fa fa-calendar"></i> &nbsp; &nbsp;
                </h4>
                <div class="form-group">
                    <iframe class="col-md-12 col-sm-12 col-xs-12 " id="report" src="" style="border:none;height:100em;">
                    </iframe>
                </div>
                -->
            </div>
        </div>
    </div>
</div>
<div class="modal right fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header alert alert-success">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel2">RIWAYAT PERIKSA</h4>
            </div>
            <div class="modal-body">
                <table class="table" data-height="299" data-sort-name="nama" data-sort-order="desc" id="tariwayat" style="display:inline; border-bottom:none;">
                    <thead>
                        <tr>
                            <th data-align="center" data-field="tanggal" data-sortable="true">
                                Tanggal
                            </th>
                            <th data-align="justify" data-field="str_rawat" data-sortable="true">
                                Rawat
                            </th>
                            <th data-align="justify" data-field="dokter" data-sortable="false" class="">
                                Dokter
                            </th>
                            <th data-align="justify" data-field="asuransi" data-sortable="false" class="">
                                Asuransi
                            </th>
                            <th data-align="justify" data-field="str_tanggal" data-sortable="false" class="hide">
                                
                            </th>
                            <th data-align="justify" data-field="tgl_kunjung" data-sortable="false" class="hide">
                                
                            </th>
                            <th data-align="justify" data-field="str_tgl_rs" data-sortable="false" class="hide">
                                
                            </th>
                            <th data-align="justify" data-field="poli" data-sortable="false" class="hide">
                                
                            </th>
                            <th data-align="justify" data-field="jam" data-sortable="false" class="hide">
                                
                            </th>
                            <th data-align="justify" data-field="rawat" data-sortable="false" class="hide">
                                
                            </th>
                        </tr>
                    </thead>
                    <tbody class="select" id="tbriwayat">
                    </tbody>
                </table>                
            </div>

        </div><!-- modal-content -->
    </div><!-- modal-dialog -->
</div><!-- modal -->
<a class="fixed-nav fixed-nav-next format- " style="top:60px !important; width:40px !important;" href="#" id="tanggal" data-toggle="modal" data-target="#myModal2">
    <span class="arrow" style="padding-left:0px !important;">Tanggal</span>
</a>