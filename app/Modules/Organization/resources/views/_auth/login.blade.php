<x-organization::auth />
<div class="m-grid m-grid--hor m-grid--root m-page">
  <div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login m-login--signin m-login--2 m-login-2--skin-2" id="m_login" style="background-color:white;">
      <div class="row">
          <div  class=" col-6 d-flex flex-row align-items-stretch justify-content-stretch justify-content-lg-start" >
              <img  width="100%" src="{!! asset('plugins/portal/media/img/WhatsApp Image 2022-12-07 at 3.52.44 PM.jpeg') !!}" />

        </div>
          <div class="col-6">
              <div class="m-grid__item m-grid__item--fluid  m-login__wrapper">
                  <div class="m-login__container">
                      <br>
                      <br>
                      <br>
                      <br>
                      <br>
                      <br>
                      <br>
                      <br>
                      <div class="m-login__signin">
                          <div class="m-login__head">
                              <h1 style="font-size: 50px">نادي التجديف الرئيسي</h1>
                              <h3 style="color: #8c8ea4	">برجاء ادخال بيانات حسابك</h3>
                          </div>
                          <form action="{{route('organizations.login')}}" method="post" id="login-form-admin" class="m-login__form m-form">
                              @csrf
                              <div class="row">
                                  <div class="col-md-12"></div>
                                  <div class="col-md-12">
                                      <label class="form-label" for="form2Example1"><h5>أسم  المستخدم </h5></label>
                                          <input
                                              style="border-radius: 40px"
                                              required=""
                                              maxlength="191"
                                              class="form-control m-input"
                                              type="text" placeholder="أسم المستخدم"
                                              name="email"
                                              value="{{old('email')}}">
                                  </div>
                                  <div class="col-md-12">
                                      <div class="form-group m-form__group">
                                          <input
                                              required=""
                                              class="form-control m-input m-login__form-input--last"
                                              type="password"
                                              placeholder="كلمة المرور"
                                              name="password">
                                      </div>
                                      <div class="row m-login__form-sub">
                                          <div class="col m--align-left m-login__form-left">
                                              <label class="m-checkbox  m-checkbox--light">
                                                  <input type="checkbox" name="rememberme"> تذكرنى
                                                  <span></span>
                                              </label>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div class="m-login__form-action">
                                  <button style="background: #454B1B;border-color: #454B1B" id="m_login_signin_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air  m-login__btn" type="submit">تسجيل الدخول</button>
                              </div>
                          </form>
                      </div>
                  </div>
              </div>
          </div>


    </div>
  </div>
</div>

