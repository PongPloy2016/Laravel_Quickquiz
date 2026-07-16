<?php $__env->startSection('head'); ?>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta name="description" content="คลังวิดีโอการเรียนการสอน - ค้นหาและเรียนรู้จากวิดีโอคุณภาพสูง">
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('css/font-awesome.min.css')); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary:       #6c47ff;
            --primary-light: #8b6bff;
            --primary-dark:  #4f2fe0;
            --accent:        #ff6b6b;
            --glass:         rgba(255,255,255,0.07);
            --glass-border:  rgba(255,255,255,0.14);
            --bg-page:       #0d0d1a;
            --bg-card:       #12122a;
            --bg-card2:      #1a1a35;
            --text-main:     #f0eeff;
            --text-muted:    #8880b5;
            --text-sub:      #c0b8f8;
            --radius:        16px;
            --radius-sm:     10px;
            --shadow:        0 8px 40px rgba(108,71,255,0.18);
            --transition:    all .25s cubic-bezier(.4,0,.2,1);
        }
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Outfit', sans-serif; background: var(--bg-page); color: var(--text-main); }
        a { text-decoration: none; color: inherit; }

        .vl-hero {
            background: linear-gradient(135deg, #0d0d1a 0%, #1a0a3e 40%, #0d0d1a 100%);
            position: relative; overflow: hidden;
            padding: 64px 0 56px; text-align: center;
        }
        .vl-hero::before {
            content: ''; position: absolute; inset: 0;
            background: radial-gradient(ellipse 80% 60% at 50% 20%, rgba(108,71,255,0.28) 0%, transparent 70%);
            pointer-events: none;
        }
        .vl-hero-orb { position: absolute; border-radius: 50%; filter: blur(80px); opacity: .35; pointer-events: none; }
        .vl-hero-orb-1 { width: 400px; height: 400px; background: var(--primary); top: -120px; left: -80px; }
        .vl-hero-orb-2 { width: 300px; height: 300px; background: var(--accent); bottom: -100px; right: -60px; }
        .vl-hero h1 {
            font-size: clamp(2rem, 5vw, 3.2rem); font-weight: 800;
            background: linear-gradient(90deg, #fff 0%, var(--primary-light) 60%, var(--accent) 100%);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
            background-clip: text; letter-spacing: -.5px; position: relative;
        }
        .vl-hero p { color: var(--text-sub); font-size: 1.1rem; margin-top: 10px; position: relative; }
        .vl-stats { display: flex; justify-content: center; gap: 24px; flex-wrap: wrap; margin-top: 36px; position: relative; }
        .vl-stat-chip {
            display: flex; align-items: center; gap: 9px;
            background: var(--glass); border: 1px solid var(--glass-border);
            backdrop-filter: blur(12px); border-radius: 50px;
            padding: 10px 22px; font-size: .92rem; font-weight: 500; color: var(--text-sub);
            transition: var(--transition);
        }
        .vl-stat-chip .vl-stat-num { font-size: 1.15rem; font-weight: 700; color: #fff; }
        .vl-stat-chip i { color: var(--primary-light); font-size: 1rem; }
        .vl-stat-chip.yt i  { color: #ff5252; }
        .vl-stat-chip.url i { color: #43d9b4; }

        .vl-toolbar {
            background: var(--bg-card); border-bottom: 1px solid rgba(255,255,255,.06);
            padding: 20px 0; position: sticky; top: 0; z-index: 90; backdrop-filter: blur(20px);
        }
        .vl-toolbar-inner { max-width: 1200px; margin: 0 auto; padding: 0 20px; display: flex; align-items: center; gap: 14px; flex-wrap: wrap; }
        .vl-search-wrap { flex: 1; min-width: 220px; position: relative; }
        .vl-search-wrap i { position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: var(--text-muted); font-size: .95rem; }
        .vl-search-wrap input {
            width: 100%; background: var(--bg-card2); border: 1.5px solid rgba(255,255,255,.1);
            border-radius: 50px; padding: 11px 18px 11px 44px; color: var(--text-main);
            font-family: 'Outfit', sans-serif; font-size: .95rem; outline: none; transition: var(--transition);
        }
        .vl-search-wrap input:focus { border-color: var(--primary); box-shadow: 0 0 0 3px rgba(108,71,255,.22); }
        .vl-search-wrap input::placeholder { color: var(--text-muted); }
        .vl-filter-btns { display: flex; gap: 8px; flex-wrap: wrap; }
        .vl-filter-btn {
            background: var(--bg-card2); border: 1.5px solid rgba(255,255,255,.1);
            border-radius: 50px; padding: 9px 20px; font-family: 'Outfit', sans-serif;
            font-size: .88rem; font-weight: 500; color: var(--text-muted); cursor: pointer; transition: var(--transition);
        }
        .vl-filter-btn:hover, .vl-filter-btn.active { background: var(--primary); border-color: var(--primary); color: #fff; transform: translateY(-1px); box-shadow: 0 4px 16px rgba(108,71,255,.4); }
        .vl-search-btn {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            border: none; border-radius: 50px; padding: 11px 26px; color: #fff;
            font-family: 'Outfit', sans-serif; font-size: .95rem; font-weight: 600;
            cursor: pointer; transition: var(--transition); display: flex; align-items: center; gap: 8px;
        }
        .vl-search-btn:hover { transform: translateY(-2px); box-shadow: 0 6px 24px rgba(108,71,255,.5); }

        .vl-content { max-width: 1200px; margin: 0 auto; padding: 36px 20px 60px; }
        .vl-section-title { display: flex; align-items: center; justify-content: space-between; margin-bottom: 28px; }
        .vl-section-title h2 { font-size: 1.25rem; font-weight: 700; color: var(--text-main); display: flex; align-items: center; gap: 10px; }
        .vl-section-title h2 span {
            background: linear-gradient(135deg, var(--primary) 0%, var(--accent) 100%);
            color: #fff; font-size: .75rem; font-weight: 700;
            padding: 3px 10px; border-radius: 50px; letter-spacing: .5px;
        }

        .vl-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 24px; }

        .vl-card {
            background: var(--bg-card); border: 1px solid rgba(255,255,255,.07);
            border-radius: var(--radius); overflow: hidden; cursor: pointer;
            transition: var(--transition); position: relative; display: flex; flex-direction: column;
        }
        .vl-card:hover { transform: translateY(-6px) scale(1.01); box-shadow: var(--shadow); border-color: rgba(108,71,255,.4); }
        .vl-card:hover .vl-thumb-overlay { opacity: 1; }
        .vl-card:hover .vl-play-btn { transform: translate(-50%,-50%) scale(1.12); }

        .vl-thumb-wrap { position: relative; aspect-ratio: 16 / 9; overflow: hidden; background: #1a1030; }
        .vl-thumb-wrap img { width: 100%; height: 100%; object-fit: cover; transition: transform .4s ease; }
        .vl-card:hover .vl-thumb-wrap img { transform: scale(1.06); }
        .vl-thumb-overlay { position: absolute; inset: 0; background: linear-gradient(135deg, rgba(108,71,255,.55) 0%, rgba(0,0,0,.45) 100%); opacity: 0; transition: var(--transition); }
        .vl-play-btn {
            position: absolute; top: 50%; left: 50%; transform: translate(-50%,-50%);
            width: 54px; height: 54px; background: rgba(255,255,255,.95);
            border-radius: 50%; display: flex; align-items: center; justify-content: center;
            transition: var(--transition); box-shadow: 0 4px 24px rgba(0,0,0,.5);
        }
        .vl-play-btn i { color: var(--primary); font-size: 1.4rem; margin-left: 3px; }
        .vl-badge { position: absolute; top: 10px; left: 10px; font-size: .72rem; font-weight: 700; letter-spacing: .5px; text-transform: uppercase; padding: 4px 10px; border-radius: 6px; backdrop-filter: blur(8px); }
        .vl-badge.yt  { background: rgba(255,82,82,.85); color: #fff; }
        .vl-badge.url { background: rgba(67,217,180,.85); color: #0a2a25; }
        .vl-duration { position: absolute; bottom: 8px; right: 10px; background: rgba(0,0,0,.75); color: #fff; font-size: .75rem; font-weight: 600; padding: 3px 8px; border-radius: 6px; backdrop-filter: blur(6px); }

        .vl-card-body { padding: 16px; flex: 1; display: flex; flex-direction: column; gap: 8px; }
        .vl-card-title { font-size: .97rem; font-weight: 600; color: var(--text-main); line-height: 1.4; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
        .vl-card-meta { display: flex; align-items: center; gap: 14px; margin-top: auto; }
        .vl-card-views { display: flex; align-items: center; gap: 5px; font-size: .8rem; color: var(--text-muted); }
        .vl-card-views i { color: var(--primary-light); font-size: .8rem; }
        .vl-watch-btn { margin-left: auto; background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%); color: #fff; font-size: .78rem; font-weight: 600; padding: 6px 14px; border-radius: 8px; border: none; cursor: pointer; transition: var(--transition); font-family: 'Outfit', sans-serif; }
        .vl-watch-btn:hover { box-shadow: 0 4px 16px rgba(108,71,255,.5); transform: translateY(-1px); }

        .vl-empty { text-align: center; padding: 80px 20px; color: var(--text-muted); }
        .vl-empty i { font-size: 4rem; opacity: .4; margin-bottom: 20px; display: block; }
        .vl-empty h3 { font-size: 1.5rem; font-weight: 700; margin-bottom: 10px; color: var(--text-sub); }

        .vl-pagination { display: flex; justify-content: center; gap: 8px; margin-top: 48px; flex-wrap: wrap; }
        .vl-pagination ul { list-style: none; display: flex; gap: 8px; flex-wrap: wrap; margin: 0; padding: 0; }
        .vl-pagination ul li { display: contents; }
        .vl-pagination a, .vl-pagination span {
            display: inline-flex; align-items: center; justify-content: center;
            min-width: 40px; height: 40px; padding: 0 12px;
            background: var(--bg-card2); border: 1.5px solid rgba(255,255,255,.1);
            border-radius: var(--radius-sm); color: var(--text-sub);
            font-family: 'Outfit', sans-serif; font-size: .9rem; font-weight: 500;
            transition: var(--transition); text-decoration: none;
        }
        .vl-pagination a:hover { background: var(--primary); border-color: var(--primary); color: #fff; transform: translateY(-2px); }
        .vl-pagination .active > a, .vl-pagination span[aria-current] { background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%); border-color: var(--primary); color: #fff; font-weight: 700; box-shadow: 0 4px 16px rgba(108,71,255,.45); }
        .vl-pagination .disabled span { opacity: .35; cursor: not-allowed; }

        .vl-modal-bg { display: none; position: fixed; inset: 0; background: rgba(5,5,20,.88); backdrop-filter: blur(14px); z-index: 9000; align-items: center; justify-content: center; padding: 20px; }
        .vl-modal-bg.open { display: flex; }
        .vl-modal { background: var(--bg-card); border: 1px solid rgba(255,255,255,.1); border-radius: 20px; width: 100%; max-width: 860px; overflow: hidden; box-shadow: 0 24px 80px rgba(0,0,0,.8); }
        .vl-modal-header { display: flex; align-items: center; justify-content: space-between; padding: 16px 22px; border-bottom: 1px solid rgba(255,255,255,.07); gap: 12px; }
        .vl-modal-header h3 { font-size: 1rem; font-weight: 600; color: var(--text-main); line-height: 1.4; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
        .vl-modal-close { width: 34px; height: 34px; border-radius: 50%; border: none; background: rgba(255,255,255,.08); color: var(--text-muted); cursor: pointer; font-size: 1.1rem; flex-shrink: 0; display: flex; align-items: center; justify-content: center; transition: var(--transition); }
        .vl-modal-close:hover { background: var(--accent); color: #fff; }
        .vl-modal-player { position: relative; aspect-ratio: 16/9; background: #000; }
        .vl-modal-player iframe, .vl-modal-player video { position: absolute; inset: 0; width: 100%; height: 100%; border: none; }
        .vl-modal-meta { padding: 14px 22px; display: flex; align-items: center; gap: 16px; border-top: 1px solid rgba(255,255,255,.07); flex-wrap: wrap; }
        .vl-modal-views { display: flex; align-items: center; gap: 6px; font-size: .85rem; color: var(--text-muted); }
        .vl-modal-views i { color: var(--primary-light); }
        .vl-modal-open-btn { margin-left: auto; display: flex; align-items: center; gap: 7px; background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%); color: #fff; font-size: .85rem; font-weight: 600; padding: 8px 18px; border-radius: 10px; transition: var(--transition); }
        .vl-modal-open-btn:hover { transform: translateY(-2px); box-shadow: 0 4px 16px rgba(108,71,255,.5); color: #fff; }

        .vl-category-tabs {
            display: flex; gap: 10px; overflow-x: auto; padding: 4px 0 20px; margin-bottom: 24px;
            scrollbar-width: none; /* Firefox */
        }
        .vl-category-tabs::-webkit-scrollbar { display: none; /* Chrome/Safari */ }
        .vl-cat-tab {
            background: var(--bg-card2); border: 1.5px solid rgba(255,255,255,.08);
            border-radius: 50px; padding: 10px 22px; font-size: .88rem; font-weight: 600;
            color: var(--text-muted); white-space: nowrap; transition: var(--transition);
            display: inline-flex; align-items: center; gap: 8px; text-decoration: none;
        }
        .vl-cat-tab:hover, .vl-cat-tab.active {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            border-color: var(--primary); color: #fff; transform: translateY(-1px);
            box-shadow: 0 4px 16px rgba(108,71,255,.4);
        }

        @media (max-width: 640px) {
            .vl-hero { padding: 44px 0 36px; }
            .vl-grid { grid-template-columns: 1fr; }
            .vl-modal { border-radius: 14px; }
            .vl-toolbar-inner { flex-direction: column; align-items: stretch; }
            .vl-search-wrap { min-width: auto; }
            .vl-filter-btns { justify-content: center; }
            .vl-category-tabs { padding: 4px 10px 20px; }
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('top_bar'); ?>
    <nav class="navbar navbar-default navbar-static-top">
        <div class="logo-main-block">
            <div class="container">
                <?php if($setting): ?>
                    <a href="<?php echo e(url('/')); ?>" title="<?php echo e($setting->welcome_txt); ?>">
                        <img src="<?php echo e(asset('/images/logo/' . $setting->logo)); ?>" class="img-responsive" alt="<?php echo e($setting->welcome_txt); ?>">
                    </a>
                <?php endif; ?>
            </div>
        </div>
        <div class="nav-bar">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#vl-navbar" aria-expanded="false">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
                            </button>
                            <?php if($setting): ?>
                                <a class="tt" title="Home" href="<?php echo e(url('/')); ?>">
                                    <h4 class="heading"><?php echo e($setting->welcome_txt); ?></h4>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="collapse navbar-collapse" id="vl-navbar">
                            <ul class="nav navbar-nav navbar-right">
                                <li><a href="<?php echo e(url('/home')); ?>" title="Home">Home</a></li>
                                <li class="active"><a href="<?php echo e(route('videolist.index')); ?>" title="Video List"><i class="fa fa-play-circle"></i> Videos</a></li>
                                <?php if(auth()->guard()->guest()): ?>
                                    <li><a href="<?php echo e(route('login')); ?>" title="Login">Login</a></li>
                                    <li><a href="<?php echo e(route('register')); ?>" title="Register">Register</a></li>
                                <?php else: ?>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo e(Auth::user()->name); ?> <span class="caret"></span></a>
                                        <ul class="dropdown-menu">
                                            <?php if($auth->role == 'A'): ?>
                                                <li><a href="<?php echo e(url('/admin')); ?>" title="Dashboard">Dashboard</a></li>
                                            <?php endif; ?>
                                            <li>
                                                <a href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('vl-logout-form').submit();">Logout</a>
                                                <form id="vl-logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display:none;"><?php echo e(csrf_field()); ?></form>
                                            </li>
                                        </ul>
                                    </li>
                                <?php endif; ?>
                                <?php if(!empty($menus)): ?>
                                    <?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><a href="<?php echo e(url('pages/' . $menu->slug)); ?>"><?php echo e($menu->name); ?></a></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="vl-hero">
        <div class="vl-hero-orb vl-hero-orb-1"></div>
        <div class="vl-hero-orb vl-hero-orb-2"></div>
        <div class="container" style="position:relative">
            <h1>&#127916; คลังวิดีโอการเรียนรู้</h1>
            <p>รวมวิดีโอคุณภาพสูงจากหลากหลายหัวข้อ เรียนรู้ได้ทุกที่ทุกเวลา</p>
            <div class="vl-stats">
                <div class="vl-stat-chip">
                    <i class="fa fa-film"></i>
                    <span class="vl-stat-num"><?php echo e($totalVideos); ?></span> วิดีโอทั้งหมด
                </div>
                <div class="vl-stat-chip yt">
                    <i class="fa fa-youtube-play"></i>
                    <span class="vl-stat-num"><?php echo e($youtubeCount); ?></span> YouTube
                </div>
                <div class="vl-stat-chip url">
                    <i class="fa fa-link"></i>
                    <span class="vl-stat-num"><?php echo e($urlCount); ?></span> URL / อัพโหลด
                </div>
            </div>
        </div>
    </div>

    <div class="vl-toolbar">
        <div class="vl-toolbar-inner">
            <form method="GET" action="<?php echo e(route('videolist.index')); ?>" id="vl-filter-form" style="display:contents;">
                <div class="vl-search-wrap">
                    <i class="fa fa-search"></i>
                    <input type="text" name="search" id="vl-search-input" value="<?php echo e($search); ?>" placeholder="ค้นหาชื่อวิดีโอ...">
                </div>
                <div class="vl-filter-btns">
                    <button type="submit" name="type" value="" class="vl-filter-btn <?php echo e($videoType === '' ? 'active' : ''); ?>">ทั้งหมด</button>
                    <button type="submit" name="type" value="youtube" class="vl-filter-btn <?php echo e($videoType === 'youtube' ? 'active' : ''); ?>"><i class="fa fa-youtube-play"></i> YouTube</button>
                    <button type="submit" name="type" value="Url" class="vl-filter-btn <?php echo e($videoType === 'Url' ? 'active' : ''); ?>"><i class="fa fa-link"></i> URL / อัพโหลด</button>
                </div>
                <button type="submit" class="vl-search-btn"><i class="fa fa-search"></i> ค้นหา</button>
            </form>
        </div>
    </div>

    <div class="vl-content">
        
        <div class="vl-category-tabs">
            <a href="<?php echo e(route('videolist.index', array_merge(request()->except('category', 'page'), ['category' => '']))); ?>" 
               class="vl-cat-tab <?php echo e($category === '' ? 'active' : ''); ?>">
               ทั้งหมด
            </a>
            <a href="<?php echo e(route('videolist.index', array_merge(request()->except('category', 'page'), ['category' => 'nursery_rhymes']))); ?>" 
               class="vl-cat-tab <?php echo e($category === 'nursery_rhymes' ? 'active' : ''); ?>">
               🎵 เพลงเด็ก & กิจกรรม
            </a>
            <a href="<?php echo e(route('videolist.index', array_merge(request()->except('category', 'page'), ['category' => 'stories']))); ?>" 
               class="vl-cat-tab <?php echo e($category === 'stories' ? 'active' : ''); ?>">
               📖 นิทานสอนใจ
            </a>
            <a href="<?php echo e(route('videolist.index', array_merge(request()->except('category', 'page'), ['category' => 'thai_language']))); ?>" 
               class="vl-cat-tab <?php echo e($category === 'thai_language' ? 'active' : ''); ?>">
               🇹🇭 ภาษาไทย & พยัญชนะ
            </a>
            <a href="<?php echo e(route('videolist.index', array_merge(request()->except('category', 'page'), ['category' => 'english']))); ?>" 
               class="vl-cat-tab <?php echo e($category === 'english' ? 'active' : ''); ?>">
               🇬🇧 ภาษาอังกฤษแสนสนุก
            </a>
            <a href="<?php echo e(route('videolist.index', array_merge(request()->except('category', 'page'), ['category' => 'science']))); ?>" 
               class="vl-cat-tab <?php echo e($category === 'science' ? 'active' : ''); ?>">
               🌿 วิทยาศาสตร์ & ธรรมชาติ
            </a>
            <a href="<?php echo e(route('videolist.index', array_merge(request()->except('category', 'page'), ['category' => 'life_skills']))); ?>" 
               class="vl-cat-tab <?php echo e($category === 'life_skills' ? 'active' : ''); ?>">
               🌟 ทักษะชีวิต
            </a>
        </div>

        <div class="vl-section-title">
            <h2>
                <i class="fa fa-play-circle" style="color:var(--primary-light)"></i>
                วิดีโอทั้งหมด
                <span><?php echo e($videos->total()); ?> รายการ</span>
            </h2>
            <?php if($search || $videoType || $category): ?>
                <a href="<?php echo e(route('videolist.index')); ?>" style="font-size:.85rem;color:var(--text-muted);display:flex;align-items:center;gap:6px;">
                    <i class="fa fa-times-circle"></i> ล้างตัวกรอง
                </a>
            <?php endif; ?>
        </div>

        <?php if($videos->count()): ?>
            <div class="vl-grid">
                <?php $__currentLoopData = $videos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $video): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $thumb    = $video->getThumbnailUrl();
                        $isYT     = $video->video_type === 'youtube';
                        $embedUrl = $isYT
                            ? "https://www.youtube.com/embed/{$video->video_id}?autoplay=1&rel=0"
                            : $video->video_url;
                    ?>
                    <div class="vl-card"
                         onclick="openModal(<?php echo e($video->id); ?>, <?php echo e(json_encode($video->video_title)); ?>, <?php echo e(json_encode($embedUrl)); ?>, <?php echo e($isYT ? 'true' : 'false'); ?>, <?php echo e(json_encode($video->video_url)); ?>, <?php echo e($video->total_views); ?>)">
                        <div class="vl-thumb-wrap">
                            <img src="<?php echo e($thumb); ?>" alt="<?php echo e($video->video_title); ?>" loading="lazy"
                                 onerror="this.src='https://via.placeholder.com/480x270/1a1a35/6c47ff?text=Video'">
                            <div class="vl-thumb-overlay"></div>
                            <div class="vl-play-btn"><i class="fa fa-play"></i></div>
                            <span class="vl-badge <?php echo e($isYT ? 'yt' : 'url'); ?>"><?php echo e($isYT ? 'YouTube' : 'Video'); ?></span>
                            <?php if($video->video_duration): ?>
                                <span class="vl-duration"><?php echo e(trim($video->video_duration)); ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="vl-card-body">
                            <div class="vl-card-title" title="<?php echo e($video->video_title); ?>"><?php echo e($video->video_title); ?></div>
                            <div class="vl-card-meta">
                                <div class="vl-card-views"><i class="fa fa-eye"></i> <span id="vl-card-views-<?php echo e($video->id); ?>"><?php echo e(number_format($video->total_views)); ?></span> วิว</div>
                                <button class="vl-watch-btn"><i class="fa fa-play"></i> ดูวิดีโอ</button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <?php if($videos->hasPages()): ?>
                <div class="vl-pagination"><?php echo e($videos->links()); ?></div>
            <?php endif; ?>
        <?php else: ?>
            <div class="vl-empty">
                <i class="fa fa-video-camera"></i>
                <h3>ไม่พบวิดีโอที่ตรงกับเงื่อนไข</h3>
                <p style="color:var(--text-muted);margin-top:8px">ลองปรับคำค้นหาหรือตัวกรองใหม่อีกครั้ง</p>
            </div>
        <?php endif; ?>
    </div>

    <div class="vl-modal-bg" id="vl-modal-bg" onclick="closeModalOnBg(event)">
        <div class="vl-modal" id="vl-modal">
            <div class="vl-modal-header">
                <h3 id="vl-modal-title">Loading...</h3>
                <button class="vl-modal-close" onclick="closeModal()" aria-label="Close"><i class="fa fa-times"></i></button>
            </div>
            <div class="vl-modal-player" id="vl-modal-player"></div>
            <div class="vl-modal-meta">
                <div class="vl-modal-views"><i class="fa fa-eye"></i> <span id="vl-modal-views">0</span> วิว</div>
                <a href="#" id="vl-modal-open-btn" class="vl-modal-open-btn" target="_blank" rel="noopener">
                    <i class="fa fa-external-link"></i> เปิดในหน้าใหม่
                </a>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
    function openModal(id, title, embedUrl, isYT, rawUrl, views) {
        document.getElementById('vl-modal-title').textContent = title;
        document.getElementById('vl-modal-views').textContent = Number(views).toLocaleString();
        document.getElementById('vl-modal-open-btn').href = rawUrl;
        var player = document.getElementById('vl-modal-player');
        player.innerHTML = '';
        if (isYT) {
            var iframe = document.createElement('iframe');
            iframe.src = embedUrl;
            iframe.allow = 'autoplay; encrypted-media; picture-in-picture';
            iframe.setAttribute('allowfullscreen', '');
            player.appendChild(iframe);
        } else {
            var video = document.createElement('video');
            video.src = rawUrl;
            video.controls = true;
            video.autoplay  = true;
            video.style.background = '#000';
            player.appendChild(video);
        }
        document.getElementById('vl-modal-bg').classList.add('open');
        document.body.style.overflow = 'hidden';

        // Increment view count via fetch POST
        var csrfMeta = document.querySelector('meta[name="csrf-token"]');
        var token = csrfMeta ? csrfMeta.getAttribute('content') : '';

        fetch('<?php echo e(url("/videolist")); ?>/' + id + '/view', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token
            }
        })
        .then(function(res) { return res.json(); })
        .then(function(data) {
            if (data.success) {
                // Update views count on the modal
                document.getElementById('vl-modal-views').textContent = Number(data.total_views).toLocaleString();
                // Update views count on the grid card
                var cardViews = document.getElementById('vl-card-views-' + id);
                if (cardViews) {
                    cardViews.textContent = Number(data.total_views).toLocaleString();
                }
            }
        })
        .catch(function(err) {
            console.error('Failed to increment view count:', err);
        });
    }
    function closeModal() {
        document.getElementById('vl-modal-bg').classList.remove('open');
        document.getElementById('vl-modal-player').innerHTML = '';
        document.body.style.overflow = '';
    }
    function closeModalOnBg(e) {
        if (e.target === document.getElementById('vl-modal-bg')) closeModal();
    }
    document.addEventListener('keydown', function(e) { if (e.key === 'Escape') closeModal(); });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/quickquiz/resources/views/videolist.blade.php ENDPATH**/ ?>