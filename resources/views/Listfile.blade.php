<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <div class="container">

    </div>
    <title>List File</title>
    @include('Template.head')

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
                            <h1 class="m-0">
                                <a href="{{ route('home') }}">
                                    <i class="fas fa-chevron-left mr-3"></i>
                                </a>
                                <span>List File {{ $borang->nama }}</span>
                            </h1>
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
                <a href="{{ route('form.upload', ['borangId' => $borang->id]) }}" type="button"
                    class="btn btn-success">Tambah Dokumen<i class="fas fa-plus-square"></i></a>
                <br>
                <br>
                <div class="row">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success" role="alert">
                            {{ $message }}
                        </div>
                    @endif

                    <table class="table table-dark table-hover">
                        <table class="table mb-4">
                            <thead>

                                <tr>

                                    <th scope="col">No</th>
                                    <th scope="col">Nama Dokumen</th>

                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($docs as $no => $doc)
                                    <tr>

                                        <td scope="row">{{ $no + 1 }}</td>
                                        <td>
                                            {{ $doc->filename }}
                                        </td>
                                        <td>
                                            <a class="btn btn-secondary btn-sm" target="_blank"
                                                href="/storage/{{ $doc->path }}">
                                                <i class="fas fa-cloud-download-alt">
                                                </i>
                                                Download / Lihat File
                                            </a>
                                        </td>
                                        <td>
                                            <a class="btn btn-danger btn-sm" href="#"
                                                onclick="confirmDelete('{{ $doc->id }}', '{{ $doc->filename }}', '{{ $borang->id }}')">
                                                <i class="fas fa-trash">
                                                </i>
                                                Hapus
                                            </a>
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
</body>

</html>
