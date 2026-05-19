@extends('layouts.dashboard.master')

@section('title', 'Edit Sub Uraian')

@section('content')

<div class="container mt-4">

    <div class="card p-4">

        <h3>Edit Sub Uraian</h3>

        <form action="{{ route('master-data.sub-uraian.update', $subUraian->id) }}"
              method="POST">

            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Uraian</label>

                <select name="uraian_id" class="form-control" required>
                    @foreach($uraian as $u)
                        <option value="{{ $u->id }}"
                            {{ $subUraian->uraian_id == $u->id ? 'selected' : '' }}>
                            {{ $u->nama_uraian }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Sub Uraian</label>

                <input type="text"
                       name="nama_sub_uraian"
                       class="form-control"
                       value="{{ $subUraian->nama_sub_uraian }}"
                       required>
            </div>

            <button type="submit" class="btn btn-primary">
                Update
            </button>

            <a href="{{ route('master-data.sub-uraian.index') }}"
               class="btn btn-secondary">
                Kembali
            </a>

        </form>

    </div>

</div>

@endsection