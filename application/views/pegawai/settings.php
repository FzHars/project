<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view("pegawai/components/header.php") ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <?php if ($this->session->flashdata('password_err')) { ?>
        <script>
            swal({
                title: "Error Password!",
                text: "Ketik Ulang Password!",
                icon: "error"
            });
        </script>
    <?php } ?>
    <?php if ($this->session->flashdata('edit')) { ?>
        <script>
            swal({
                title: "Success!",
                text: "Data Berhasil Diedit!",
                icon: "success"
            });
        </script>
    <?php } ?>
    <?php if ($this->session->flashdata('eror_edit')) { ?>
        <script>
            swal({
                title: "Erorr!",
                text: "Data Gagal Diedit!",
                icon: "error"
            });
        </script>
    <?php } ?>
    <?php if ($this->session->flashdata('input')) { ?>
        <script>
            swal({
                title: "Success!",
                text: "Data Berhasil Dilengkapi!",
                icon: "success"
            });
        </script>
    <?php } ?>

    <?php if ($this->session->flashdata('eror')) { ?>
        <script>
            swal({
                title: "Erorr!",
                text: "Data Gagal Ditambahkan!",
                icon: "error"
            });
        </script>
    <?php } ?>
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="<?= base_url(); ?>assets/admin_lte/dist/img/Loading.png"
                alt="AdminLTELogo" height="60" width="60">
        </div>

        <!-- Navbar -->
        <?php $this->load->view("pegawai/components/navbar.php") ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php $this->load->view("pegawai/components/sidebar.php") ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Informasi data</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Setting</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Info content -->
            <section class="content">
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Data anda</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table  class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Nama Lengkap</th>
                                                <th>Jenis Kelamin</th>
                                                <th>No Hp</th>
                                                <th>NIP</th>
                                                <th>Pangkat</th>
                                                <th>Jabatan</th>
                                                <th>Alamat</th>
                                                <th>Ubah data</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $id = 0;
                                            foreach($pegawai_data as $i)
                                            :
                                            $id++;
                                            $id_user = $i['id_user'];
                                            $username = $i['username'];
                                            $password = $i['password'];
                                            $nama_lengkap = $i['nama_lengkap'];
                                            $jenis_kelamin = $i['jenis_kelamin'];
                                            $email = $i['email'];
                                            $nip = $i['nip'];
                                            $pangkat = $i['pangkat'];
                                            $jabatan = $i['jabatan'];
                                            $no_telp = $i['no_telp'];
                                            $alamat = $i['alamat'];
                                            
                                            ?>
                                            <tr>
                                                <td><?= $nama_lengkap ?></td>
                                                <td><?= $jenis_kelamin ?></td>
                                                <td><?= $no_telp ?></td>
                                                <td><?= $nip ?></td>
                                                <td><?= $pangkat ?></td>
                                                <td><?= $jabatan ?></td>
                                                <td><?= $alamat ?></td>
                                                <td>
                                                    <div class="table-responsive">
                                                        <div class="table table-striped table-hover ">
                                                            <a href="" class="btn btn-primary" data-toggle="modal"
                                                                data-target="#exampleModal">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            
                                            <?php endforeach;?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>

                </div><!-- /.container-fluid -->
            </section>


            <br>
            <hr>
            <!-- /.content -->

            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Setting</h1>
                        </div>

                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">

                    <form action="<?= base_url(); ?>Settings/settings_account_pegawai" method="POST">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username"
                                aria-describedby="Username" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password"
                                aria-describedby="password" required>
                        </div>
                        <div class="form-group">
                            <label for="re_password">Ulangi Password</label>
                            <input type="password" class="form-control" id="re_password" name="re_password"
                                aria-describedby="re_password" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div><!-- /.container-fluid -->
            </section>
            <br>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->


        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <?php $this->load->view("pegawai/components/js.php") ?>
</body>

</html>