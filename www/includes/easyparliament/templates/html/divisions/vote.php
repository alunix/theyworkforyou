<div class="debate-header regional-header regional-header--<?= $current_assembly ?>">
    <div class="regional-header__overlay"></div>
    <div class="full-page__row">
        <div class="debate-header__content full-page__unit">
              <h1><?= $division['division_title'] ?></h1>
            <p class="lead">
                Division number <?= $division['number'] ?> <?= $location ?>
                <?php if ($debate_time_human) { ?>at <?= $debate_time_human ?><?php } ?>
                on <?= $debate_day_human ?>.
            </p>
        </div>
    </div>
    <?php include dirname(__FILE__) . '/../section/_section_nav.php'; ?>
</div>

<div class="full-page">
    <div class="debate-speech">
        <div class="full-page__row">
            <div class="full-page__unit">
                <div class="debate-speech__division">

                    <h2 class="debate-speech__division__header">
                        <img src="/images/bell.png">
                        <small class="debate-speech__division__number">Division number <?= $division['number'] ?></small>
                        <strong class="debate-speech__division__title"><?= $division['division_title'] ?></strong>
                    </h2>

                  <?php if (isset($data['mp_data'])) {
                    include('_your_mp.php');
                  } ?>

                    <div class="debate-speech__division__details">
                      <p>
                      <?php if (!$division['has_description'] || !isset($mp_vote) || !in_array($mp_vote['vote'], array('aye', 'no'))) { ?>
                          <span class="policy-vote__text">
                              <?php include('_vote_description.php'); ?>
                          </span><br>
                      <?php } else { ?>
                          <?php if ($mp_vote['with_majority']) { ?>
                              <?php $vote_prefix = 'A majority of ' . $division['members']['plural']  . ' <b>agreed</b> and'; include('_vote_description.php'); ?>
                          <?php } else { ?>
                              <?php $vote_prefix = 'A majority of ' . $division['members']['plural'] . ' <b>disagreed</b> and'; include('_vote_description.php'); ?>
                          <?php } ?>
                      <?php } ?>
                      </p>
                    </div>

                    <div class="debate-speech__division__details">
                      <?php include '_votes.php'; ?>
                    </div>

                </div>

                <ul class="debate-speech__meta debate-speech__links">
                  <?php if (isset($division['debate_url'])) { ?>
                    <li class="link-to-speech">
                        <a class="link debate-speech__meta__link" href="<?= $division['debate_url'] ?>">Show full debate</a>
                    </li>
                  <?php } ?>
                  <?php if (isset($mp_data) && isset($mp_vote)) { ?>
                    <li>
                        <a class="internal-link debate-speech__meta__link" href="<?= $mp_data['mp_url'] ?>/votes"><?= $mp_data['name'] ?>&rsquo;s full voting record</a>
                    </li>
                  <?php } ?>
                </ul>

            </div>
        </div>
    </div>
</div>
