@extends('layouts.dashboard.master')

@section('title', 'Edit Uraian')

@section('content')

<div class="container mt-4">

    <div class="card p-4">

        <h3>Edit Uraian</h3>

        <form action="{{ route('master-data.uraian.update', $uraian->id) }}"
              method="POST">

            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Kategori</label>

                <select name="kategori_id"
                        class="form-control"
                        required>

                    @foreach($kategori as $k)
                        <option value="{{ $k->id }}"
                            {{ $uraian->kategori_id == $k->id ? 'selected' : '' }}>
                            {{ $k->nama_kategori }}
                        </option>
                    @endforeach

                </select>
            </div>

            <div class="mb-3">
                <label>Nama Uraian</label>

                <input type="text"
                       name="nama_uraian"
                       class="form-control"
                       value="{{ $uraian->nama_uraian }}"
                       required>
            </div>

            <button type="submit" class="btn btn-primary">
                Update
            </button>

            <a href="{{ route('master-data.uraian.index') }}"
               class="btn btn-secondary">
                Kembali
            </a>

        </form>

    </div>

</div>

@endsection