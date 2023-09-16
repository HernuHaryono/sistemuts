<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <div class="container">
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </div>
    <title>Borang UTS</title>
    @include('Template.head')
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        @include('Template.navbar')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('Template.left-sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Monitoring Borang</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Starter Page</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->

            <div class="container">
                <a href="{{ route('tambahdokumen') }}" type="button" class="btn btn-success">Tambah Borang <i
                        class="fas fa-plus-square"></i></a>
                <br>
                <br>
                <div class="row">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success" role="alert">
                            {{ $message }}
                        </div>
                    @endif

                    <table class="table table-bordered">
                        <table class="table mb-4">

                            <thead>
                                <tr>
                                    <th scope="col">Centang</th>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Keterangan</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Deadline</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($borang as $no => $data)
                                    <tr>
                                        <td>
                                            <input type="checkbox" @if ($data->status == '1') checked @endif
                                                onchange="updatestatus('{{ $data->id }}', '{{ $data->status }}')"
                                                id="head-id">
                                        </td>
                                        <td scope="row">{{ $no + 1 }}</td>
                                        <td>{{ $data->nama }}</td>
                                        <td>{{ $data->keterangan }}</td>
                                        <td>

                                            @if ($data->status == 0)
                                                <button class="btn btn-warning btn-sm">
                                                    Belum Selesai
                                                </button>
                                            @else
                                                <button class="btn btn-success btn-sm">
                                                    Selesai
                                                </button>
                                            @endif

                                        </td>
                                        <td>{{ $data->deadline }}</td>
                                        <td>{{ $data->dokumen }}</td>
                                        <td>
                                            <div>

                                                {{-- <a class="btn btn-primary btn-sm"
                                                    href="{{ route('form.upload', ['borangId' => $data->id]) }}">
                                                    <i class="fas fa-upload">
                                                    </i>
                                                    Upload
                                                </a> --}}
                                                <a class="btn btn-info btn-sm"
                                                    href="/tampilkandata/{{ $data->id }}">
                                                    <i class="fas fa-pencil-alt">
                                                    </i>
                                                    Edit
                                                </a>
                                                <a class="btn btn-danger btn-sm" href="/delete/{{ $data->id }}">
                                                    <i class="fas fa-trash">
                                                    </i>
                                                    Delete
                                                </a>

                                                <a class="btn btn-secondary btn-sm"
                                                    href="{{ route('listDocument', ['borangId' => $data->id]) }}">
                                                    <i class="fas fa-cloud-download-alt">
                                                    </i>
                                                    List File
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>

                        </table>
                    </table>
                </div>
            </div>

            <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
        <div class="p-3">
            <h5>Title</h5>
            <p>Sidebar content</p>
        </div>
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    @include('Template.footer')
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    @include('Template.script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(idDOc, filename, borangId) {
            Swal.fire({
                title: `Hapus file ${filename} ?`,
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = `/listdocument/${borangId}/${idDOc}/delete`
                    // Swal.fire(
                    //     'Deleted!',
                    //     'Your file has been deleted.',
                    //     'success'
                    // )
                }
            })
        }
    </script>
    <script src="https://unpkg.com/axios@1.1.2/dist/axios.min.js"></script>
    <script>
        window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
        let token = '{{ csrf_token() }}';
        if (token) {
            window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token;
        } else {
            alert('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
        }
    </script>
    <script>
        function updatestatus(id, status) {
            let updatestatus = status == '0' ? '1' : '0'

            // if (status == '0') {
            //     let updatestatus = '1'
            // } else {
            //     let updatestatus = '0'
            // }

            const payload = {
                status: updatestatus
            };
            axios.post(`/updatestatus/${id}`, payload).then(response => {
                Swal.fire({
                    title: `Success!`,
                    text: "Data berhasil diupdate.",
                    icon: 'success',
                }).then(() => {
                    location.reload();
                })
            }).catch(error => {
                if (error.response) {
                    Swal.fire({
                        title: error.response.data.msg,
                        text: error.response.data.error_msg,
                        icon: 'error',
                    })
                } else {
                    Swal.fire({
                        title: "Terjadi kesalahan!",
                        text: "Mohon hubungi admin",
                        icon: 'error',
                    })
                }

            })
        }
    </script>

</body>

</html>
