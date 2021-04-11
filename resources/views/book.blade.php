@extends('adminlte::page')

@section('title', 'Pengelolaan Buku')

@section('content_header')
    <h1>Pengelolaan Buku</h1>
@stop

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{__('Pengelolaan Buku')}}
                    </div>
                    <div class="card-body">

                            <button class="btn btn-primary" data-toggle="modal" data-target="#tambahBukuModal"><i class="fa fa-plus"></i>Tambah Data</i></button><br><br>

                        <table class="table table-borderer" id="table-data">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>JUDUL</th>
                                    <th>PENULIS</th>
                                    <th>TAHUN</th>
                                    <th>PENERBIT</th>
                                    <th>COVER</th>
                                    <th>AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no=1;@endphp
                                @foreach ($books as $book)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $book->judul }}</td>
                                        <td>{{ $book->penulis }}</td>
                                        <td>{{ $book->tahun}}</td>
                                        <td>{{ $book->penerbit}}</td>
                                        <td>
                                            @if ($book->cover !== null)
                                                <img src="{{asset('storage/cover_buku/'.$book->cover)}}" width="100px">
                                            @else
                                                [Gambar Tidak Tersedia]
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="basic example">
                                                <button type="button" id="btn-edit-buku" class="btn btn-success" data-toggle="modal" data-target="#editbukumodal" data-id="{{ $book->id }}">Edit</button>
                                                <button type="button" id="btn-delete-buku" class="btn btn-danger" data-toggle="modal" data-target="#deletebukumodal" data-id="{{ $book->id }}" data-cover="{{ $book->id}}">Hapus</button>
                                            </div>
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




    <div class="modal fade" id="tambahBukuModal" tabindex="-1" aria-labelledby="exampleModallabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModallabel">Tambah Data Buku</h5>
              <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="post" action="{{ route('admin.books.submit')}}" enctype="multipart/form-data">
                @csrf
                    <div class="form-group">
                        <label for="judul">Judul Buku</label>
                        <input type="text" class="form-control" name="judul" id="judul"required>
                    </div>
                    <div class="form-group">
                        <label for="penulis">Penulis</label>
                        <input type="text" class="form-control" name="penulis" id="penulis"required>
                    </div>
                    <div class="form-group">
                        <label for="tahun">Tahun</label>
                        <input type="datetime" class="form-control" name="tahun" id="tahun"required>
                    </div>
                    <div class="form-group">
                        <label for="penerbit">Penerbit</label>
                        <input type="text" class="form-control" name="penerbit" id="penerbit"required>
                    </div>
                    <div class="form-group">
                        <label for="cover">Cover</label>
                        <input type="file" class="form-control" name="cover" id="cover">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary" name="submit">Kirim</button>
                      </div>
                  </form>
            </div>
          </div>
        </div>
      </div>


      <div class="modal fade" id="editbukumodal" tabindex="-1" aria-labelledby="exampleModallabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModallabel">Edit Data Buku</h5>
              <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="POST" action="{{ route('admin.books.update')}}" enctype="multipart/form-data">
              @foreach($books as $b)
                @csrf
                @method('POST')
                    <div class="form-group">
                        <label for="judul">Judul Buku</label>
                        <input type="text" class="form-control" name="judul" value="{{ $b->judul}}" id="edit-judul"required>
                    </div>
                    <div class="form-group">
                        <label for="penulis">Penulis</label>
                        <input type="text" class="form-control" name="penulis" value="{{ $b->penulis}}" id="edit-penulis"required>
                    </div>
                    <div class="form-group">
                        <label for="tahun">Tahun</label>
                        <input type="datetime" class="form-control" name="tahun" value="{{ $b->tahun}}" id="edit-tahun"required>
                    </div>
                    <div class="form-group">
                        <label for="penerbit">Penerbit</label>
                        <input type="text" class="form-control" name="penerbit" value="{{ $b->penerbit}}" id="edit-penerbit"required>
                    </div>
                    <div class="form-group">
                        <label for="cover">Cover</label>
                        <input type="file" class="form-control" name="cover" value="{{ $b->cover}}" id="edit-cover">
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id" id="edit-id">
                        <input type="hidden" name="old_cover" id="edit-old-cover">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary" name="submit">Update</button>
                      </div>
                      @endforeach
                  </form>
            </div>
          </div>
        </div>
      </div>



      <div class="modal fade" id="deletebukumodal" tabindex="-1" aria-labelledby="exampleModallabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModallabel">Hapus Data Buku</h5>
              <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            Apakah Anda Yakin Akan Menghapus Data Tersebut?
              <form method="post" action="{{ route('admin.books.delete')}}" enctype="multipart/form-data">
              
                @csrf
                @method('DELETE')
                   
                    <div class="modal-footer">
                        <input type="hidden" name="id" id="delete-id">
                        <input type="hidden" name="old_cover" id="delete-old-cover">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-danger" name="submit">Hapus</button>
                      </div>
                      
                  </form>
            </div>
          </div>
        </div>
      </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        $(function(){
            $(documnet).on('click', '#btn-edit-buku', function(){
                let id =$(this).data('id');
                $('image-area').empty();
                $.ajax({
                    type: "get",
                    url: baseurl+'/admin/ajaxadmin/dataBuku/'+id,
                    dataType: 'json',
                    success: function(res){
                        $('#edit-judul').val(res.judul);
                        $('#edit-penerbit').val(res.penerbit);
                        $('#edit-penulis').val(res.penulis);
                        $('#edit-tahun').val(res.tahun);
                        $('#edit-id').val(res.id);
                        $('#edit-old-cover').val(res.judul);

                        if(res.cover !== null){
                            $('#image-area').append(
                                "<img src='"baseurl+"/storage/cover_buku/"+res.cover+"' width='200px' />"
                            );
                        }else{
                            $('#image-area').append('[Gambar Tidak Tersedia]');
                        }
                    },
                });
            });

            $(documnet).on('click', '#btn-delete-buku', function(){
                let id =$(this).data('id');
                let cover =$(this).data('cover');

                $('#delete-id').val(id);
                $('#delete-old-cover').val(cover);
            });
        }) ;
    </script>
@stop
