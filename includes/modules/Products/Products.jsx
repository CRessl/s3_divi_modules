// External Dependencies
import React, { Component } from 'react';

// Internal Dependencies
import './style.css';


class S3DM_Products extends Component {

  static slug = 's3dm_products';

  render() {
    
    const data = this.props.__productsData;
    console.log(data);
    let items;

    items = 'No Data available';


    return (
      <div>
        {items}
      </div>
    );
  }
}

export default S3DM_Products;
