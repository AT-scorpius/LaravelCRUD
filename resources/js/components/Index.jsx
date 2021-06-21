import axios from 'axios';
import { json } from 'body-parser';
import React, { Component } from 'react'
import { Table } from 'react-bootstrap';
export default class Index extends Component {
  constructor(props) {
    super(props);
    this.state = {
      listProduct: []
    };
  }
  componentDidMount(){
		this.getProduct();
	}
    getProduct=()=>{

        axios.get('http://localhost:8000/api/v1/data')
  .then((response) => {
    // console.log(response.data);
    console.log(response.status);
   let  list=response.data;
    console.log(list);
    this.setState( {listProduct: list ? list : [], } );
    // console.log(response.statusText);
    // console.log(response.headers);
    // console.log(response.config);
  }).catch(err=>console.log(err));
    }
  render() {
    const products=this.state.listProduct;
    if (products.length){
      showProduct=products.map((car,index)=>{  //lặp qua mảng cars, cứ mỗi phần tử thì lưu vào biến car
            return (
            <CarItem key={car.id?car.id:0} car={car}/>
            ); //đóng return
    }); //đóng map
    }//đóng if
    return (
      <div>
        <Table>

                            <thead>
                              <tr>
                                <th>Stt</th>
                                <th>ID</th>
                                <th>Name Product</th>
                                <th>Manufactorer</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                              {
                         		{products.length === 0 ?
                              (<tbody><tr><td><h2>No Data Found!</h2></td></tr></tbody>) :
                              (<tbody>{showProduct}</tbody>)}
                               }
                              </tr>
                            </tbody>
        </Table>
      </div>
    )
  }
}
