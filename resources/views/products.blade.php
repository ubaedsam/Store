<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
</head>
<body>
    
    <section style="padding-top: 60px;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            Product 
                            <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#productModal">Tambah Product</a>
                        </div>
                        <div class="card-body">
                            <table id="productTable" class="table">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Nama Product</th>
                                        <th>Jenis Product</th>
                                        <th>Jumlah</th>
                                        <th>Harga</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($product as $item)
                                        <tr id="pid{{ $item->id }}">
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->nama_product }}</td>
                                            <td>{{ $item->jenis_product }}</td>
                                            <td>{{ $item->jumlah }}</td>
                                            <td>{{ $item->harga }}</td>
                                            <td>
                                                <a href="javascript:void(0)" onclick="editProduct({{ $item->id }})" class="btn btn-info">Edit</a>
                                                <a href="javascript:void(0)" onclick="deleteProduct({{ $item->id }})" class="btn btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
  
    <!-- Tambah Data Product Modal -->
    <div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Product</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="productForm">
                    @csrf
                    <div class="form-group">
                        <label for="nama_product">Nama Product</label>
                        <input type="text" class="form-control" id="nama_product">
                    </div>
                    <div class="form-group">
                        <label for="jenis_product">Jenis Product</label>
                        <input type="text" class="form-control" id="jenis_product">
                    </div>
                    <div class="form-group">
                        <label for="jumlah">Jumlah</label>
                        <input type="text" class="form-control" id="jumlah">
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="text" class="form-control" id="harga">
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
        </div>
    </div>

    <!-- Ubah Data Product Modal -->
    <div class="modal fade" id="productEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Data Product</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="productEditForm">
                    @csrf
                    <input type="hidden" id="id" name="id" />
                    <div class="form-group">
                        <label for="nama_product">Nama Product</label>
                        <input type="text" class="form-control" id="nama_product2">
                    </div>
                    <div class="form-group">
                        <label for="jenis_product">Jenis Product</label>
                        <input type="text" class="form-control" id="jenis_product2">
                    </div>
                    <div class="form-group">
                        <label for="jumlah">Jumlah</label>
                        <input type="text" class="form-control" id="jumlah2">
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="text" class="form-control" id="harga2">
                    </div>
                    <button type="submit" class="btn btn-primary">Ubah</button>
                </form>
            </div>
        </div>
        </div>
    </div>

    {{-- Proses Tambah Data Product Ajax --}}
    <script>
        $("#productForm").submit(function(e){
            e.preventDefault();

            let nama_product = $("#nama_product").val();
            let jenis_product = $("#jenis_product").val();
            let jumlah = $("#jumlah").val();
            let harga = $("#harga").val();
            let _token = $("input[name=_token]").val();

            $.ajax({
                url: "{{route('product.add')}}",
                type:"POST",
                data:{
                    nama_product:nama_product,
                    jenis_product:jenis_product,
                    jumlah:jumlah,
                    harga:harga,
                    _token:_token
                },
                success:function(response)
                {
                    if(response)
                    {
                        $("#productTable tbody").prepend('<tr><td>'+ response.nama_product +'</td><td>'+ response.jenis_product +'</td><td>'+ response.jumlah +'</td><td>'+ response.harga +'</td></tr>');
                        $("#productForm")[0].reset();
                        $("#productModal").modal('hide');
                    }
                }
            });
        });
    </script>

    {{-- Proses Ubah Data Product Ajax --}}
    <script>
        // Mengambil data product berdasarkan id ke dalam box modal
        function editProduct(id)
        {
            $.get('/productss/'+id,function(product){
                $("#id").val(product.id);
                $("#nama_product2").val(product.nama_product);
                $("#jenis_product2").val(product.jenis_product);
                $("#jumlah2").val(product.jumlah);
                $("#harga2").val(product.harga);
                $("#productEditModal").modal('toggle');
            });
        }

        // Menyimpan data product yang sudah diubah berdasarkan id
        $("#productEditForm").submit(function(e){
            e.preventDefault();

            let id = $("#id").val();
            let nama_product = $("#nama_product2").val();
            let jenis_product = $("#jenis_product2").val();
            let jumlah = $("#jumlah2").val();
            let harga = $("#harga2").val();
            let _token = $("input[name=_token]").val();

            $.ajax({
                url:"{{ route('product.update') }}",
                type:"PUT",
                data:{
                    id:id,
                    nama_product:nama_product,
                    jenis_product:jenis_product,
                    jumlah:jumlah,
                    harga:harga,
                    _token:_token
                },
                success:function(response){
                    $('#pid'+ response.id +' td:nth-child(1)').text(response.nama_product);
                    $('#pid'+ response.id +' td:nth-child(2)').text(response.jenis_product);
                    $('#pid'+ response.id +' td:nth-child(3)').text(response.jumlah);
                    $('#pid'+ response.id +' td:nth-child(4)').text(response.harga);
                    $("#productEditModal").modal('toggle');
                    $("#productEditForm")[0].reset();
                }
            })
        })
    </script>

    {{-- Proses Hapus Data --}}
    <script>
        function deleteProduct(id)
        {
            if(confirm("Apakah anda yakin ingin menghapus data product ini ?"))
            {
                $.ajax({
                    url: '/productss/'+id,
                    type:'DELETE',
                    data:{
                        _token : $("input[name=_token]").val()
                    },
                    success:function(response)
                    {
                        $("#pid"+id).remove();
                    }
                });
            }
        }
    </script>

</body>
</html>