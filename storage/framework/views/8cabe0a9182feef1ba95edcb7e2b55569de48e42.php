<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Telzir</title>
</head>

<body>
    <section class="intro">
        <div class="container">
            <div class="row justify-content-center">

                <?php if($errors->any()): ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
                <?php endif; ?>

                <div class="col-12 col-lg-9 col-xl-7">
                    <div class="card">
                        <div class="card-body p-4 p-md-5">
                            <h3 class="mb-4 pb-2">Telzir, plano Fale Mais</h3>
                            <form action="<?php echo e(url('countsMinutes')); ?>" method="post">
                                <?php echo csrf_field(); ?>
                                <div class="row">
                                    <div class="col-md-3 mb-2">
                                        <select name="origin" id="origin" class="form-control">
                                            <option value='padrao' selected="selected">Origem</option>
                                            <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($city->cod_id); ?>"><?php echo e($city->cod_ddd); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>

                                    <div id='id-destiny' class="col-md-3 mb-2">
                                        <select name="destiny" id='destiny' class="form-control">
                                            <option value="padrao" selected="selected">Destino</option>
                                            <?php $__currentLoopData = $destinys; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $destiny): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($destiny->cod_id); ?>"><?php echo e($destiny->cod_ddd); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>

                                    <div class="col-md-3 mb-2">
                                        <select name="destiny" id='destiny11' class="form-control">
                                            <option value="" selected="selected">Destino</option>
                                            <?php $__currentLoopData = $destyny11; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($d->cod_id); ?>"><?php echo e($d->cod_ddd); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>

                                    <div class="col-md-4 mb-2">
                                        <div class="form-outline datepicker">
                                            <input type="text" class="form-control" name="time" id="time" maxlength="4" placeholder="Tempo da ligação" />
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <h6 class="mb-2 pb-1">Planos: </h6>
                                        <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="form-check form-check">
                                            <input class="form-check-input" type="radio" name="falemais" id="falemais" value="<?php echo e($plan->cod_id); ?>" />
                                            <label class="form-check-label" for="<?php echo e($plan->name); ?>"><?php echo e($plan->name); ?></label>
                                        </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                    <div class="mt-4">
                                        <input class="btn btn-warning btn-lg" type="submit" value="Calcular" />
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php if($tabs): ?>
                    <table>
                    <tr>
                        <td width="20%">
                            <div align="center">Origem</div>
                        </td>
                        <td width="20%">
                            <div align="center">Destino</div>
                        </td>
                        <td width="20%">
                            <div align="center">Tempo</div>
                        </td>
                        <td width="20%">
                            <div align="center">Plano</div>
                        </td>
                        <td width="20%">
                            <div align="center">valor com plano</div>
                        </td>
                        <td width="20%">
                            <div align="center">Valor sem plano</div>
                        </td>
                    </tr>
                    <?php $__currentLoopData = $tabs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tab): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <tr>
                        <td>
                            <div align="center"><?php echo e($tab->origin); ?></div>
                        </td>
                        <td>
                            <div align="center"><?php echo e($tab->destiny); ?> </div>
                        </td>
                        <td>
                            <div align="center"><?php echo e($tab->time); ?></div>
                        </td>
                        <td>
                            <div align="center"><?php echo e($tab->plan); ?> </div>
                        </td>
                        <td>
                            <div align="center"><?php echo e($tab->price); ?></div>
                        </td>
                        <td>
                            <div align="center"><?php echo e($tab->price_a); ?></div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </table>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>




</body>

<script>
    jQuery(document).ready(function($) {
        $('#destiny11').hide();
        $('#destiny').hide();

        $('#origin').change(function() {
            var e = document.getElementById("origin");
            var d = document.getElementById("destiny");
            var f = document.getElementById("destiny11");

            if ((e.value == 1) && (e.value != 'padrao')) {
                f.value = null;
                $('#destiny11').hide();
                $('#destiny').show();
            } else if ((e.value != 1) && (e.value != 'padrao')) {
                d.value = null;
                $('#destiny11').show();
                $('#destiny').hide();
            }
            if (e.value == 'padrao') {

                $('#destiny11').hide();
                $('#destiny').hide();

            }

        });
    })
</script>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

</html><?php /**PATH C:\Users\Douglas\Desktop\codigo\DesafioLOL_1\resources\views/index.blade.php ENDPATH**/ ?>