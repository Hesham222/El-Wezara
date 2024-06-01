<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ticket</title>
</head>

<style type="text/css">

$grey-light: hsl(200, 10%, 92%);
$grey: hsl(200, 10%, 85%);
$grey-dark: hsl(200, 10%, 70%);
$shadow: hsla(200, 20%, 20%, 0.25);
$red: #dc143c;

$bg: hsl(200, 0%, 100%);
$divider: $grey-light;
$border: $grey-dark;

$cutout-size: 1rem;

*,
*::after {
  box-sizing: border-box;
  margin: 0;
}

body {
  display: flex;
  align-items: center;
  justify-content: center;
  min-height: 100vh;
  color: hsl(200, 10%, 30%);
  background-color: hsl(200, 10%, 96%);
  background-image: linear-gradient(to bottom left, $grey-dark, $grey);
}

.ticket {
  display: grid;
  grid-template-rows: auto 1fr auto;
  max-width: 24rem;
  &__header,
  &__body,
  &__footer {
    padding: 1.25rem;
    background-color: $bg;
    border: 1px solid $border;
    box-shadow: 0 2px 4px $shadow;
  }
  &__header {
    font-size: 1.5rem;
    border-top: 0.25rem solid $red;
    border-bottom: none;
    box-shadow: none;
  }
  &__wrapper {
    box-shadow: 0 2px 4px $shadow;
    border-radius: 0.375em 0.375em 0 0;
    overflow: hidden;
  }
  &__divider {
    position: relative;
    height: $cutout-size;
    background-color: $bg;
    margin-left: ($cutout-size / 2);
    margin-right: ($cutout-size / 2);
    &::after {
      content: '';
      position: absolute;
      height: 50%;
      width: 100%;
      top: 0;
      border-bottom: 2px dashed $divider;
    }
  }
  &__notch {
    position: absolute;
    left: ($cutout-size / 2) * -1;
    width: $cutout-size;
    height: $cutout-size;
    overflow: hidden;
    &::after {
      content: '';
      position: relative;
      display: block;
      width: ($cutout-size * 2);
      height: ($cutout-size * 2);
      right: 100%;
      top: -50%;
      border: ($cutout-size / 2) solid $bg;
      border-radius: 50%;
      box-shadow: inset 0 2px 4px $shadow;
    }
    &--right {
      left: auto;
      right: ($cutout-size / 2) * -1;
      &::after {
        right: 0;
      }
    }
  }
  &__body {
      border-bottom: none;
      border-top: none;
    & > * + * {
      margin-top: 1.5rem;
      padding-top: 1.5rem;
      border-top: 1px solid $divider;
    }
  }
  &__section {
    & > * + * {
      margin-top: 0.25rem;
    }
    & > h3 {
      font-size: 1.125rem;
      margin-bottom: 0.5rem;
    }
  }
  &__header,
  &__footer {
    font-weight: bold;
    font-size: 1.25rem;
    display: flex;
    justify-content: space-between;
  }
  &__footer {
    border-top: 2px dashed $divider;
    border-radius: 0 0 0.325rem 0.325rem;
  }
}
</style>

<body>

    <article class="ticket">
        <header class="ticket__wrapper">
          <div class="ticket__header">
            الرقم التعريفي : {{ $ticket->id }} 🎟
          </div>
        </header>
        <div class="ticket__divider">
          <div class="ticket__notch"></div>
          <div class="ticket__notch ticket__notch--right"></div>
        </div>
        <div class="ticket__body">
          <section class="ticket__section">
            <h3>نوع التذكرة : {{ $ticket->details->category->name }} / {{  $ticket->details->subCategory->name }}</h3>
            <p>البوابة :{{ $ticket->gate->name }}</p>
            <p>المبلغ :{{ $ticket->price }} جنية</p>
            <p>تاريخ الاصدار :{{ $ticket->created_at }}</p>
          </section>
        </div>
      </article>


      <br>
      <br>
      <a style="
      padding-bottom: 299px;display:none;" id="back" href="{{ route('organizations.ticket.create') }}" class="btn btn-primary">العوده للتذاكر</a>
</body>

<script>


setTimeout(
    function() {
        window.print();
    }, 100);
setTimeout(function(){

    document.getElementById("back").style.display = "block";

 }, 5000);

 window.onafterprint = back;

        function back() {
            window.history.back();
        }

</script>

</html>
