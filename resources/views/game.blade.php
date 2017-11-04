@extends('layouts.app')

@section('content')
<!--the components for the game -->
    <game-component></game-component>
    <messagebox-component></messagebox-component>
    <players-component></players-component>
    <example-component></example-component>
<!--the components for the game -->

    <div class="container">
        <form action="/task/1" method="POST" v-ajax>
            {{  method_field('DELETE') }}
            {{ csrf_field() }}
            <button type="submit">Delete Post</button>
        </form>
    </div>
@endsection

