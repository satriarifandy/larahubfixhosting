@extends('layouts.master')

@section('content')

<div class="container">
<a href="/create/question" class="btn btn-primary mt-4 mb-4">Buat Pertanyaan Baru</a>
  <table class="table">
    <thead class="thead-dark">
      <tr>
        <th scope="col" class="text-center pb-4">No</th>
        <th scope="col" class="text-center pb-4">Judul</th>
        <th scope="col" class="text-center pb-4">Isi</th>
        <th scope="col" class="text-center">Total Vote</th>
        <th scope="col" class="text-center pb-4">Aksi</th>
      </tr>
    </thead>
    <tbody>
    
      @foreach ($questions as $qst)
      <tr>
        <th scope="row" style="width: 5%">{{$loop->iteration}}</th>
        <td style="width: 20%">{{ $qst->title }}</td>
        <td>{!! $qst-> content !!}</td>
        <td>{{$qst->votes->sum('upvote')-$qst->votes->sum('downvote')}}</td>
        <td style="width: 20%;text-align:center;">
          <a class="btn btn-info" href="/questions/{{$qst->id}}" role="button">Detail</a>
          
          @php $Auth_user_id = isset(Auth::user()->id)?Auth::user()->id:false;
          @endphp
          @if ($qst->user_id == $Auth_user_id)
            <a class="btn btn-warning" href="/questions/{{$qst->id}}/edit" role="button">Edit</a>
            <form action="/questions/{{$qst->id}}" style="display: inline" method="post">
              @csrf
              @method('DELETE')
              <button class="btn btn-danger" role="button"><i class="fas fa-trash-alt"></i></button>
            </form>
          @endif
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

@endsection