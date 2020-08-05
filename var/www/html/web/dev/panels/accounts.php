<?php
require_once __DIR__ . "/../../../API/autoload.php";
session_start();
$_SESSION['FLAG_DEVELOPER_VERBOSE'] = true;
\Union\API\Respondus\Respondus::listen();
//var_dump();
require_once __DIR__ . "/../../../src/php/elements/container/container_start.php";
?>

    <section class="hero is-small is-warning is-bold">
        <div class="hero-head">
            <?php
            require_once __DIR__ . "/../../../src/php/elements/navbar/navbar_admin_active.php";
            require_once __DIR__ . "/../../../API/autoload.php";
            ?>
        </div>

        <div class="hero-body">
            <div class="container">
                <h2 class="subtitle">
                    Developer Mode
                </h2>
                <h1 class="title">
                    Accounts
                </h1>

            </div>
        </div>


    </section>
    <section class="section">
        <br>
        <div class="container" id="main_page_content">
            <p class="title">
                Actions
            </p>
            <div class="field has-addons">
                <p class="control">
                    <button onclick="MicroModal.show('account-create-modal')" class="button is-primary">
      <span class="icon is-small ">
        <i class="fas fa-plus"></i>
      </span>
                        <span>Create Account</span>
                    </button>
                </p>
                <p class="control">
                    <button class="button">
      <span class="icon is-small">
        <i class="fas fa-align-center"></i>
      </span>
                        <span>Center</span>
                    </button>
                </p>
                <p class="control">
                    <button class="button">
      <span class="icon is-small">
        <i class="fas fa-align-right"></i>
      </span>
                        <span>Right</span>
                    </button>
                </p>
            </div>
            </div>
        </div>
    </section>

<!--Modals-->

<!--Account Creation Modal-->
    <div class="modal micromodal-slide" id="account-create-modal" aria-hidden="true">
        <div class="modal__overlay" tabindex="-1" data-micromodal-close>
            <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-1-title">
                <header class="">
                    <h2 class="title is-4" >
                        Create Account
                    </h2>
                    <h2 class="subtitle is-6" >
                        Generate a linked or unlinked profile
                    </h2>
<!--                    <button class="modal__close" aria-label="Close modal" ></button>-->
                </header>
                <main class="modal__content" id="modal-1-content">
                    <div class="field">
                        <form action="accounts.php?create" method="post">

                                <div class="field">
                                    <p class="control is-expanded has-icons-left">
                                        <input class="input is-warning" type="text" name="create_name_first" placeholder="First Name">
                                        <span class="icon is-small is-left">
                                          <i class="fas fa-user"></i>
                                       </span>
                                    </p>
                                </div>
                                <div class="field">
                                    <p class="control is-expanded has-icons-left">
                                        <input class="input is-warning" type="text" name="create_name_last" placeholder="Last Name">
                                        <span class="icon is-small is-left">
                                          <i class="fas fa-user"></i>
                                       </span>
                                    </p>
                                </div>
                            <article class="message is-warning">
                                <div class="message-body">
                                    These are required fields.
                                </div>
                            </article>
                            <br>
                                <div class="field">
                                    <p class="control is-expanded has-icons-left has-icons-right">
                                        <input class="input is-primary" type="email" name="create_email" placeholder="Email">
                                        <span class="icon is-small is-left">
                                            <i class="fas fa-envelope"></i>
                                        </span>
                                    </p>
                                </div>
                                <div class="field is-expanded">
                                    <div class="field has-addons">
                                        <p class="control">
                                            <a class="button is-static">
                                                +1
                                            </a>
                                        </p>
                                        <p class="control is-expanded">
                                            <input class="input is-primary" type="tel" name="create_phone" placeholder="Phone number">
                                        </p>
                                    </div>
                                </div>
                            <article class="message is-primary">
                                <div class="message-body">
                                    If either the phone number or E-Mail is blank, the user must add this when they log in or create their account.
                                </div>
                            </article>
                            <br>
                                <div class="field">
                                    <p class="control is-expanded has-icons-left has-icons-right">
                                        <input class="input is-info" type="password" name="create_email" placeholder="Password">
                                        <span class="icon is-small is-left">
                                            <i class="fas fa-lock"></i>
                                        </span>
                                    </p>
                                </div>
                            <article class="message is-info">
                                <div class="message-body">
                                    Without a password, the system will generate an unlinked profile the user must create their own account. All information saved under the phone number or email will be transferred to this new account once they register.
                                </div>
                            </article>
                                <div class="field">
                                    <div class="control">
                                        <button type="submit" class="button is-primary is-light is-medium">
                                            Continue
                                        </button>
                                        <button type="submit" data-micromodal-close class="button is-light is-medium">
                                            Cancel
                                        </button>

                                    </div>
                                </div>

                        </form>
                    </div>
                </main>
            </div>
        </div>
    </div>


<?php
require_once __DIR__ . "/../../../src/php/elements/container/container_end.php";
?>