@extends('dashboard.layouts.layout')

{{-- Title Page --}}
@section('title_page')
    <title>{{ config('app.name') }} | {{ __('words.add post') }}</title>
@endsection

<!-- Breadcrumb -->
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard.dashboard') }}">{{ __('words.dashboard') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('dashboard.posts.index') }}">{{ __('words.posts') }}</a></li>
    <li class="breadcrumb-item">{{ __('words.add post') }}</li>
@endsection

@section('body')
    <div class="container-fluid">
        <div class="animated fadeIn">
            <form action="{{ Route('dashboard.posts.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="row">
                    <div class="card">
                        <div class="card-header">
                            <strong>{{ __('words.add post') }}</strong>
                        </div>
                        @include('dashboard.posts._form')
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('css')
    <link href="{{ asset('adminassets/css/tagify.css') }}" rel="stylesheet">
    <style>
        .tagify{    
            width: 100%;
            max-width: 100%;
        }

        .tags-look .tagify__dropdown__item{
            display: inline-block;
            border-radius: 3px;
            padding: .3em .5em;
            border: 1px solid #CCC;
            background: #F3F3F3;
            margin: .2em;
            font-size: .85em;
            color: black;
            transition: 0s;
        }

        .tags-look .tagify__dropdown__item--active{
            color: black;
        }

        .tags-look .tagify__dropdown__item:hover{
            background: lightyellow;
            border-color: gold;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/43.0.0/ckeditor5.css" />
@endpush

@push('javascripts')
    <script src="{{ asset('adminassets/js/tagify.js') }}"></script>
    <script>
        // data => {
        //     [
        //         { id: 1, name: 'محمد' },
        //         { id: 2, name: 'علي' },
        //         { id: 3, name: 'سالم' }
        //     ]   
        // }
        var input = document.querySelector('input[name="tags"]');
        var whitelist = ["A# .NET", "A# (Axiom)", "A-0 System", "A+", "A++", "ABAP", "ABC", "ABC ALGOL", "ABSET", "ABSYS", "ACC", "Accent", "Ace DASL", "ACL2", "Avicsoft", "ACT-III", "Action!", "ActionScript", "Ada", "Adenine", "Agda", "Agilent VEE", "Agora", "AIMMS", "Alef", "ALF", "ALGOL 58", "ALGOL 60", "ALGOL 68", "ALGOL W", "Alice", "Alma-0", "AmbientTalk", "Amiga E", "AMOS", "AMPL", "Apex (Salesforce.com)", "APL", "AppleScript", "Arc", "ARexx", "Argus", "AspectJ", "Assembly language", "ATS", "Ateji PX", "AutoHotkey", "Autocoder", "AutoIt", "AutoLISP / Visual LISP", "Averest", "AWK", "Axum", "Active Server Pages", "ASP.NET", "B", "Babbage", "Bash", "BASIC", "bc", "BCPL", "BeanShell", "Batch (Windows/Dos)", "Bertrand", "BETA", "Bigwig", "Bistro", "BitC", "BLISS", "Blockly", "BlooP", "Blue", "Boo", "Boomerang", "Bourne shell (including bash and ksh)", "BREW", "BPEL", "B", "C--", "C++ – ISO/IEC 14882", "C# – ISO/IEC 23270", "C/AL", "Caché ObjectScript", "C Shell", "Caml", "Cayenne", "CDuce", "Cecil", "Cesil", "Céu", "Ceylon", "CFEngine", "CFML", "Cg", "Ch", "Chapel", "Charity", "Charm", "Chef", "CHILL", "CHIP-8", "chomski", "ChucK", "CICS", "Cilk", "Citrine (programming language)", "CL (IBM)", "Claire", "Clarion", "Clean", "Clipper", "CLIPS", "CLIST", "Clojure", "CLU", "CMS-2", "COBOL – ISO/IEC 1989", "CobolScript – COBOL Scripting language", "Cobra", "CODE", "CoffeeScript", "ColdFusion", "COMAL", "Combined Programming Language (CPL)", "COMIT", "Common Intermediate Language (CIL)", "Common Lisp (also known as CL)", "COMPASS", "Component Pascal", "Constraint Handling Rules (CHR)", "COMTRAN", "Converge", "Cool", "Coq", "Coral 66", "Corn", "CorVision", "COWSEL", "CPL", "CPL", "Cryptol", "csh", "Csound", "CSP", "CUDA", "Curl", "Curry", "Cybil", "Cyclone", "Cython", "Java", "Javascript", "M2001", "M4", "M#", "Machine code", "MAD (Michigan Algorithm Decoder)", "MAD/I", "Magik", "Magma", "make", "Maple", "MAPPER now part of BIS", "MARK-IV now VISION:BUILDER", "Mary", "MASM Microsoft Assembly x86", "MATH-MATIC", "Mathematica", "MATLAB", "Maxima (see also Macsyma)", "Max (Max Msp – Graphical Programming Environment)", "Maya (MEL)", "MDL", "Mercury", "Mesa", "Metafont", "Microcode", "MicroScript", "MIIS", "Milk (programming language)", "MIMIC", "Mirah", "Miranda", "MIVA Script", "ML", "Model 204", "Modelica", "Modula", "Modula-2", "Modula-3", "Mohol", "MOO", "Mortran", "Mouse", "MPD", "Mathcad", "MSIL – deprecated name for CIL", "MSL", "MUMPS", "Mystic Programming L"];
        // const whitelist = data.map(tag => ({
        //     value: tag.name, // استخدم الخاصية المناسبة لاسم العلامة
        //     id: tag.id // استخدم الخاصية المناسبة لمعرف العلامة
        // }));
        var tagify = new Tagify(input, {
            whitelist:whitelist,
            maxTags: 10,
            dropdown: {
                maxItems: 20,          
                classname: "tags-look", 
                enabled: 0,            
                closeOnSelect: false   
            }
        })
    </script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>
    <script>
        var allEditors = document.querySelectorAll('#editor');
        for (var i = 0; i < allEditors.length; ++i) {
            ClassicEditor.create(allEditors[i]);
        }

        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script>
@endpush