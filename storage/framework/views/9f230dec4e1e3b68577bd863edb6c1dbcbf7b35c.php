<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="<?php echo e(url('/')); ?>">
            <?php echo e(config('app.name', 'Picturegram')); ?>

        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="<?php echo e(__('Toggle navigation')); ?>">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <?php if(auth()->guard()->check()): ?>
            <div class="container">
                <a href="/your-inbox">Inbox</a>
    </div>
    <?php endif; ?>
            <!-- <ul class="navbar-nav mr-auto">
                <?php if(auth()->guard()->check()): ?>
                <?php if(Route::has('user.post.index')): ?>
                <li class="nav-item">
                    <a href="<?php echo e(route('user.post.index')); ?>" class="nav-link">
                        Posts
                    </a>
                </li>
                <?php endif; ?>
                <?php endif; ?>
            </ul> -->

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                <?php if(auth()->guard()->guest()): ?>
                <?php if(Route::has('login')): ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(route('login')); ?>"><?php echo e(__('Login')); ?></a>
                </li>
                <?php endif; ?>

                <?php if(Route::has('register')): ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(route('register')); ?>"><?php echo e(__('Register')); ?></a>
                </li>
                <?php endif; ?>
                <?php else: ?>
                <li class="nav-item dropdown users-list">
               <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        <?php if(Cache::has('user-is-online-'.auth()->user()->id)): ?><i class="fa fa-circle"></i><?php endif; ?>    
                  <?php echo e(Auth::user()->name); ?>

                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                        <a class="dropdown-item" href="<?php echo e(route('home',auth()->user()->id)); ?>"><?php echo e(__('My Profile')); ?></a>

                        <hr class="navbar-divider">
                        <a class="dropdown-item" href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                            <?php echo e(__('Logout')); ?>

                        </a>

                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                            <?php echo csrf_field(); ?>
                        </form>
                    </div>
                </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav><?php /**PATH E:\xampp\htdocs\pictura-app-main\resources\views/layouts/partials/navbar.blade.php ENDPATH**/ ?>