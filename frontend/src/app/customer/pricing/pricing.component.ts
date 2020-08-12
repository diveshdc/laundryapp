import { Component, OnInit } from '@angular/core';
import { ProductCategoryService } from '../../services/product-category.service';
import { PriceService } from '../../services/price.service';
import { AuthService } from '../../services/auth.service';


@Component({
  selector: 'app-pricing',
  templateUrl: './pricing.component.html',
  styleUrls: ['./pricing.component.css']
})
export class PricingComponent implements OnInit {
  categories: []
  productOfCategory: any;
  userData: any;
  quantity: any;
  selectedCategory: any;
  badgeCount: any;
  userId: any;
  quantityCount: any;

  constructor(private productCategoryService: ProductCategoryService, private priceservice: PriceService,private authservice:AuthService) { }

  ngOnInit(): void {
    this.getUserData();
  }

  onScroll(e) {
    if(this.productOfCategory.length>=100) {
      console.log('No more items');
      return;
    }
    // console.log('scrolled!!', e);
    // const moreProducts = ti
    // this.productOfCategory = [...this.productOfCategory, ...moreProducts];
  }

  getUserData(){
    this.authservice.getUser().subscribe(async res => {
      if (res['status'] == true) {
          this.userData = res['data'];
          this.userId = res['data'].id;
          this.getCategoryList();
      } else {
        console.log(res);
      }
    }, (error) => {
      console.log('error', 'Spotlex', error.error.message);
    })
  }

  getCategoryList() {
    const payload ={
      user_id:this.userData['id'],
    }
    this.productCategoryService.getCategoryList(payload).subscribe(async res => {
      if (res['status'] == true) {
        this.quantityCount = res['quantity_count'];
        this.categories = res['categoriesArray'];
        for (let i = 0; i < res['categoriesArray'].length; i++) {
          let obj = res['categoriesArray'][i];
          if(i == 0 ){
            this.getProductByCatId(obj.id)
          }
      }
      } else {
        console.log(res);
      }
    }, (error) => {
      console.log('error', 'Spotlex', error.error.message);
    })
  }

  getProductByCatId(id) {
    this.selectedCategory = id;
    this.categories.forEach((element) => {
      if(element['id'] == id){
        this.productOfCategory = element['category_product']['data'];
      }
    })
    }

    getQuantity(productId,userId) {
      const result = this.quantityCount.filter(element => {
       if(element.product_id ==productId && element.user_id ==userId ){
        return true;
       }
      });
      return result[0]?result[0].quantity:0
    }


    // getCurrentQuantity(productId,userId) {
    //   const result = this.quantityCount.filter(element => {
    //    if(element.product_id ==productId && element.user_id ==userId ){
    //       console.log(element,'elementelementelementelementelementelementelementelementelementelement')
    //    }
    //   });
    // }

    addToCart(product,value) {
      this.quantityCount.forEach(element => {
        console.log(element.product_id,'-====------',product.id)
        if(element.product_id ==product.id && element.user_id == this.userId){
          this.quantity =element.quantity;
          if(value =='plus')
            this.quantity ++;
            if(value =='minus')
            this.quantity --;
          }else{
          this.quantity = 0
            if(value =='plus') {
            this.quantity ++;
              console.log(this.quantity,'=============')
            }if(value =='minus') {
              if(this.quantity >0){
                this.quantity ++;
              }else{
                this.quantity --;
              }
              }
        }
       });
      const payLoad ={
        'user_id':this.userData.id,
        'product_id':product.id,
        'name':product.name,
        'price':product.price,
        'sale_price':product.sale_price,
        'quantity':this.quantity,
        'category_id':this.selectedCategory,
        'description':product.description,
        'image':product.image,
      }
      console.log(payLoad,'payloadddddd')
        this.priceservice.addToCart(payLoad).subscribe(async res => {
          if (res['status'] == true) {
            this.quantity ='';
            console.log(res['CartItem'],'=======================')
            this.badgeCount = res['CartItem'].quantity;
          } else {
            
          }
        }, (error) => {

        })
      }
}
