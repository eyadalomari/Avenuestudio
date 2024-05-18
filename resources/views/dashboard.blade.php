@extends('layouts.app')

@section('content')
<div class="side-bar">
	<h2>Sidebar</h2>
	<a href="#home">Home</a>
	<a href="#services">Services</a>
	<a href="#about">About</a>
	<a href="#contact">Contact</a>
</div>
<div class="main-content">
</div>
<style>
	.side-bar {
		 background-color: #51e2f5;
		 color: white;
		 padding: 20px;
		 width: 250px;
		 position: fixed;
		 height: 100%;
	}
	.side-bar a {
		 color: white;
		 text-decoration: none;
		 display: block;
		 margin: 10px 0;
	}
	.side-bar a:hover {
		 background-color: #495057;
		 border-radius: 4px;
	}
	.main-content {
		 margin-left: 250px;
		 padding: 20px;
		 width: 100%;
	}
</style>
@endsection
