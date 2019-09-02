@extends('layout')

@section('content')
    <h1> Create a new project </h1>

    <form method="POST" action="/projects" >


        {{ csrf_field() }}
        <div class="field">
            <div class="control">
                <input type="text" class="input {{$errors->has('title') ? 'is-danger' : '' }}" name="title" placholder="Project title" value="{{ old('title') }}" required >
            </div>
        </div>

        <div class="field">
            <div class="control">
                <textarea name="description"  class="textarea {{$errors->has('description') ? 'is-danger' : '' }}"   placholder="Project description" required >{{ old('description') }}</textarea>
            </div>
        </div>

        <div class="field">
            <div class="control">
                <button class="button is-link" type="submit">Create Project</button>
            </div>

        </div>
       
       @include('errors')
       
    </form>

@endsection
