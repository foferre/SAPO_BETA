@extends('layouts.administration')

@section('content')

<h2 class="mb-4">Invoice</h2>

<div class="card">
  <div class="card-body">
    <div class="row py-5">
      <div class="col-md-10 offset-md-1">
          <div class="row">
              <div class="col-md">
                  <h1 class="text-uppercase">Invoice</h1>
              </div>
              <div class="col-md text-md-right">
                  <img src="http://via.placeholder.com/200x50">
                  <p class="mt-2 mb-0">
                      123 Business Street<br>
                      Toronto, ON
                  </p>
              </div>
          </div>

          <hr class="my-5">

          <div class="row">
              <div class="col-md">
                  <h5 class="text-uppercase">Date</h5>
                  <p class="mb-0">June 18, 2019</p>
              </div>
              <div class="col-md text-md-center">
                  <h5 class="text-uppercase">Invoice No.</h5>
                  <p class="mb-0">234252342</p>
              </div>
              <div class="col-md text-md-right">
                  <h5 class="text-uppercase">Invoice To</h5>
                  <p class="mb-0">
                      Other Company<br>
                      456 Business Street<br>
                      Ottawa, ON
                  </p>
              </div>
          </div>

          <hr class="my-5">

          <table class="table table-borderless mb-0">
              <thead>
              <tr class="border-bottom text-uppercase">
                  <th scope="col">Description</th>
                  <th scope="col">Hours</th>
                  <th scope="col">Rate</th>
                  <th scope="col" class="text-right">Total</th>
              </tr>
              </thead>
              <tbody>
              <tr>
                  <td>Service #1</td>
                  <td>10</td>
                  <td>$40.00</td>
                  <td class="text-right">$400.00</td>
              </tr>
              <tr>
                  <td>Service #2</td>
                  <td>10</td>
                  <td>$50.00</td>
                  <td class="text-right">$500.00</td>
              </tr>
              <tr>
                  <td>Service #1</td>
                  <td>20</td>
                  <td>$15.00</td>
                  <td class="text-right">$300.00</td>
              </tr>
              <tr class="bg-light font-weight-bold">
                  <td></td>
                  <td></td>
                  <td class="text-uppercase">Subtotal</td>
                  <td class="text-right">$1,200.00</td>
              </tr>
              <tr class="bg-light font-weight-bold">
                  <td></td>
                  <td></td>
                  <td class="text-uppercase">Tax</td>
                  <td class="text-right">$156.00</td>
              </tr>
              <tr class="bg-light font-weight-bold">
                  <td></td>
                  <td></td>
                  <td class="text-uppercase">Total</td>
                  <td class="text-right">$1,356.00</td>
              </tr>
              </tbody>
          </table>
      </div>
    </div>
  </div>
</div>
@endsection
