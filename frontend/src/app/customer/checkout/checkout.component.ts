import { Component, OnInit } from '@angular/core';
import { FormBuilder, Validators, FormGroup } from '@angular/forms';
import { AuthService } from 'app/services/auth.service';
import { Router } from '@angular/router';
import { ValidationService } from 'app/services/validation.service';

@Component({
  selector: 'app-checkout',
  templateUrl: './checkout.component.html',
  styleUrls: ['./checkout.component.css']
})
export class CheckoutComponent implements OnInit {
  public account_validation_messages = ValidationService.account_validation_messages;
  userId: any;
  finalPrice: number;
  couponForm: FormGroup;
  deliveryNotesForm: FormGroup;
  errorMessage: any;
  successMsg: any;
  isCouponCode: boolean;
  deliverySlotId: any;
  collectionSlotId: any;
  deliveryTime: any;
  collectionDate: any;
  collectionTime: any;
  deliveryDate: any;
  constructor(private formBuilder: FormBuilder, private authservice: AuthService, private route: Router) {
    this.couponForm = this.formBuilder.group({
      coupon_code: ['', [Validators.required]]
      });

  }

  ngOnInit(): void {
    this.getUserData();
  }

    /**
   * Function to validate all form fields
   * @param formGroup
   */
  validateAllFormFields(formGroup: FormGroup) {
    Object.keys(formGroup.controls).forEach(field => {
      const control = formGroup.get(field);
      control.markAsTouched({ onlySelf: true });
      control.markAsDirty({ onlySelf: true });
    });
  }


  getUserData() {
    this.authservice.getUser().subscribe(async res => {
      if (res['status'] === true) {
        this.userId = res['data'].id
        this.getPrice(res['data'].id);
      } else {

      }
    }, (error) => {
      this.authservice.showToastrMessage('error', 'Spotlex', error.error.message);
    })
  }

  getPrice(userId) {
    this.authservice.getCartItems(userId).subscribe(async res => {
      if (res['status'] === true) {
              this.finalPrice = 0;
              res['CartData'].forEach(element => {
                let total = 0;
                for (let i = 0; i < element.price.length; i++) {
                  total = element.price;
                }
                this.finalPrice = total;
              });
      } else {

      }
    }, (error) => {
      this.authservice.showToastrMessage('error', 'Spotlex', error.error.message);
    })
  }

  applyCoupon() {
    console.log(this.finalPrice, '---------------------------')
    if (this.couponForm.invalid) {
      this.validateAllFormFields(this.couponForm);
      return true;
    } else {
      this.authservice.applyCoupon({'couponcode': this.couponForm.value, 'actual_price': this.finalPrice}).subscribe(async res => {
        if (res['status'] === true) {
          console.log(res['couponData'].discount, '--------------', this.finalPrice)
          // tslint:disable-next-line:radix
          this.finalPrice = this.finalPrice - parseInt(res['couponData'].discount);
          this.isCouponCode = true;
          this.errorMessage = '';
          this.successMsg  = res['message'];
          this.authservice.showToastrMessage('success', 'Spotlex', res['message']);
        } else {
          this.errorMessage = res['message'];
          this.successMsg = '';
          this.isCouponCode = false;
          this.authservice.showToastrMessage('error', 'Spotlex', res['message']);
        }
      }, (error) => {
        this.authservice.showToastrMessage('error', 'Spotlex', error.error.message);
      })
  }
}


checkOut() {
  const payLoad = {
    'is_couponcode': this.isCouponCode,
    // 'delivery_notes': this.deliveryNotesForm,
    'delivery_slot_id': this.deliverySlotId,
    'collection_slot_id': this.collectionSlotId,
    'delivery_time': this.deliveryTime,
    'delivery_date': this.deliveryDate,
    'collection_time': this.collectionTime,
    'collection_date': this.collectionDate,
    'user_id': this.userId,
    'final_price': this.finalPrice
  }
  console.log(payLoad)
  this.authservice.checkOut(payLoad).subscribe(async res => {
    if (res['status'] === true) {

      this.authservice.showToastrMessage('success', 'Spotlex', res['message']);
    } else {
      this.authservice.showToastrMessage('error', 'Spotlex', res['message']);
    }
  }, (error) => {
    this.authservice.showToastrMessage('error', 'Spotlex', error.error.message);
  })
}

  goBack() {
    window.history.go(-1); return false;
  }

}
