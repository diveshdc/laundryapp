import { Component, OnInit } from '@angular/core';
import { FormGroup, FormBuilder, Validators } from '@angular/forms';
import { ValidationService } from 'app/services/validation.service';
import { AuthService } from 'app/services/auth.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-basket',
  templateUrl: './basket.component.html',
  moduleId: module.id,
  styleUrls: ['./basket.component.css']
})
export class BasketComponent implements OnInit {

  informationForm: FormGroup;
  public account_validation_messages = ValidationService.account_validation_messages;
  userId: any;
  CartItemsData: any;
  totalItems: any;
  totalPrice: any;
  constructor(private formBuilder: FormBuilder, private authservice: AuthService, private route: Router) {
    this.informationForm = this.formBuilder.group({
      email: ['', [Validators.required,
                   Validators.pattern('^[a-zA-Z0-9_!#$%&\'*+/=? \\"`{|}~^.-]+@[a-zA-Z0-9.-]+$'),
                   ValidationService.avoidEmptyStrigs]
                  ],
      password : ['', [Validators.required, Validators.minLength(6)]],
      postcode : ['', [Validators.required]],
      address : ['', [Validators.required]],
      new_password : ['', [Validators.required, Validators.minLength(6)]],
      password_confirmation : ['', [Validators.required, Validators.minLength(6)]],
      first_name : ['', [Validators.required]],
      last_name : ['', [Validators.required]],
      phone_number : ['', [Validators.required, Validators.minLength(10)]],
      street_name : ['', [Validators.required]],
      town : ['', [Validators.required]],
      building_name_no : ['', [Validators.required]],
      });
   }

  ngOnInit(): void {
    this.getUserData();
  }


  getUserData() {
    this.authservice.getUser().subscribe(async res => {
      if (res['status'] === true) {
        this.userId = res['data'].id
        this.informationForm.patchValue(res['data'])
        this.getCartItems(res['data'].id);
      } else {

      }
    }, (error) => {
      this.authservice.showToastrMessage('error', 'Spotlex', error.error.message);
    })
  }

  getCartItems(userId) {
    this.authservice.getCartItems(userId).subscribe(async res => {
      if (res['status'] === true) {
            this.CartItemsData = res['CartData'];
              this.totalItems = res['quantity_count'];
              this.totalPrice = 0;
              res['CartData'].forEach(element => {
                let total = 0;
                for (let i = 0; i < element.price.length; i++) {
                  total += element.price[i];
                }
                this.totalPrice = total;
              });
      } else {

      }
    }, (error) => {
      this.authservice.showToastrMessage('error', 'Spotlex', error.error.message);
    })
  }

  // totalItemsPrice(votes) {
  //    console.log(votes, 'asdsadsdgaskdgak')

  // }

  EditAddress() {

  }

  goToCheckout(): void {
    // this.route.navigate(['/ckeckout', this.totalPrice]);
    this.route.navigate(['/checkout']);
}

  goBack() {
    window.history.go(-1); return false;
  }
}
