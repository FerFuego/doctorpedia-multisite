
<div class="hero" style="<?php echo (!get_sub_field('show_search')) ? 'height: 280px' : ''; ?>">
    <div class="hero__content container">
        <div class="hero__content__header">
            <h1><?php echo get_sub_field('title'); ?></h1>
            <p class="<?php echo (!get_sub_field('show_search')) ? 'mb-0' : ''; ?>"><?php echo get_sub_field('copy'); ?></p>
        </div>
        <?php if (get_sub_field('show_search')) : ?>
            <?php $dataExpert = getExpertsDD(); ?>
            <div class="hero__content__body">
                <form action="" class="hero__content__body__form">
                    <select name="searchSpecialty" id="searchSpecialty" class="searchSpecialty" data-live-search="true">
                        <option value="">Search Specialties ...</option>
                        <option value="">All Specialties</option>
                        <?php foreach ($dataExpert['specialties'] as $specialty) : ?>
                            <option value="<?php echo $specialty; ?>"><?php echo $specialty; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <select name="searchExpertise" id="searchExpertise" class="searchSpecialty" data-live-search="true">
                        <option value="">Search Topics ...</option>
                        <option value="">All Topics</option>
                        <?php foreach ($dataExpert['areas'] as $area) : ?>
                            <option value="<?php echo $area; ?>"><?php echo $area; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <select name="filterByExpert" id="filterByExpert" class="searchSpecialty" onchange="filterToProfile(this)" data-live-search="true">
                        <option value="">Search by Name ...</option>
                        <?php foreach ($dataExpert['experts'] as $expert) : ?>
                            <option value="<?php echo $expert->ID; ?>"><?php echo $expert->display_name; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <select name="sortBy" id="sortBy" class="sortBy" data-live-search="false">
                        <option value="">Sort by ...</option>
                        <option value="last_name">Alphabetical</option>
                        <option value="c_activity">Recent Activity</option>
                        <option value="c_videos">Most Videos</option>
                        <option value="c_articles">Most Articles</option>
                        <option value="c_blogs">Most Blogs</option>
                        <option value="c_reviews">Most Reviews</option>
                    </select>
                    <input type="hidden" name="current_page" id="current_page" value="<?php echo get_query_var('paged') ? (int) get_query_var('paged') : 1; ?>">
                </form>
            </div>
        <?php endif; ?>
    </div>
</div>