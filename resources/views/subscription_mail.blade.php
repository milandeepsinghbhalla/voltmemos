<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
<title>New Blog Published..!!</title>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="card col-lg-8 col-11">
            <div class="card-header bg-dark text-light">
                Hi {{$username}}
            </div>
            <div class="card-body">
                <h5 class="card-title">A new blog has been published in {{$category}}....!!</h5>
                <p class="card-text">Go and check out the new blog published in {{$category}}
                    don't forget to share your response through comments....!!
                </p>
            </div>
        </div>
        <div class="col-12 text-center">
            Thanks , Yourmemos
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
</body>
