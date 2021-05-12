// External Dependencies
import React, { Component } from 'react';
import $ from 'jquery';
// Internal Dependencies
import './style.css';


class S3DM_LinkList extends Component {

  static slug = 's3dm_link_list';

  draw_lines(itemsToConnect){

      var itemsCount = itemsToConnect.length;
      var maxItems = itemsCount - 1;

      var index = 0;

      for (var i = 0; i <= itemsCount; i++) {

          var nextIndex = index+1;

          if(nextIndex > maxItems){
              nextIndex = 0;
          }

          // eslint-disable-next-line
          itemsToConnect.each(function(ItemIndex, item){

              if(ItemIndex > index){

                  var currentItem = itemsToConnect.get(index);
                  var nextItem = itemsToConnect.get(ItemIndex);

                  var currentItemWidth = $(currentItem).outerWidth();
                  var currentItemHeight = $(currentItem).outerHeight();

                  var nextItemWidth = $(nextItem).outerWidth();
                  var nextItemHeight = $(nextItem).outerHeight();
                  
                  var currentItemPositions = $(currentItem).position();
                  var nextItemPositions = $(nextItem).position();

                  var x1 = currentItemPositions.left + (currentItemWidth /2);
                  var y1 = currentItemPositions.top + (currentItemHeight /2);

                  var x2 = nextItemPositions.left + (nextItemWidth / 2);
                  var y2 = nextItemPositions.top + (nextItemHeight / 2);
                  
                  /*
                  * Create path
                  */
                  var aLine = document.createElementNS('http://www.w3.org/2000/svg', 'line');
                  aLine.setAttribute('x1', x1);
                  aLine.setAttribute('y1', y1);
                  aLine.setAttribute('x2', x2);
                  aLine.setAttribute('y2', y2);
                  aLine.setAttribute('index', index);
                  aLine.setAttribute('stroke', 'black');
                  aLine.setAttribute('stroke-width', '4');

                  $("#paths").append(aLine);


              }

          });
        
          index++;
      }

  }


  renderImage(src){

    if(src === undefined || src === null || !src){
      return;
    }

    return (
      <div className="s3dm_link_list_item_image">
          <img src={src} alt="frontend_render" />
      </div>
    )

  }

  renderChildren(){

    const content = this.props.content;
    let items = content.map((item, index) => {
      let attributes = item.props.attrs;

      let style = {
        'left' : attributes.position_left+'%',
        'top'  : attributes.position_top+'%',
        'width': attributes.width,
        'height': attributes.height
      }

      return (
        <div className="s3dm_link_list_item_bubble" style={style} index={index} key={index} top={style.top} left={style.left}>

          <div>
            {this.renderImage(attributes.src)}

            <div className="s3dm_link_list_item_content">
                {attributes.title}
            </div>
            </div>

        </div>
      );
    });

    return items;
  }

  componentDidMount(){
  
    this.renderLines();
    window.addEventListener('resize', this.updateDimensions);
   
  }

  componentWillUnmount() {
  
    window.removeEventListener('resize', this.updateDimensions);
  
  }

  renderLines(){
    let windowWidth = $(window).width();
    let itemsToConnect = $('.s3dm_link_list_item_bubble');
    let linkListContainer = $('.s3dm_link_list');

    

    $('#paths line').remove();
    

    if(windowWidth > 960){

      if(linkListContainer.find('.wrapper').hasClass('s3dm_link_list_mobile_list_view uk-child-width-1-1 uk-child-width-1-3@s')){
        linkListContainer.find('.wrapper').removeClass('s3dm_link_list_mobile_list_view');
        linkListContainer.find('.wrapper').removeClass('uk-child-width-1-1 uk-child-width-1-3@s uk-grid-small uk-grid');
        linkListContainer.find('.wrapper').removeAttr('uk-grid');
      }

      itemsToConnect.each(function(index, item) {

        $(this).css({
            'top': item.attributes.top.nodeValue,
            'left' : item.attributes.left.nodeValue
        });

      });
    }

   

    if(windowWidth < 960){

        linkListContainer.find('.wrapper').addClass('s3dm_link_list_mobile_list_view');
        linkListContainer.find('.wrapper').addClass('uk-child-width-1-1 uk-child-width-1-3@s uk-grid-small');
        linkListContainer.find('.wrapper').attr('uk-grid', '');
        itemsToConnect.removeAttr('style');
        linkListContainer.removeAttr('style');

    }

  }
  updateDimensions = () => {
      this.renderLines();
  }


  render() {

    let $height = false;
	  let $maxHeight = false;
    
    if(!$maxHeight){
        $maxHeight = '800px';
    }

    if(!$height){
        $height = '800px';
    }

    let style = { 
        'height': $height,
        'maxHeight': $maxHeight
    }

    const classes = 's3dm_link_list uk-position-relative '+this.props.list_layout;

    return (
        <div className={classes} style={style} >
            <div className="wrapper">
              {this.renderChildren()}
            </div>
            <svg height="800" width="100%" id="paths">

            </svg>
        </div>
    );
  }

}

export default S3DM_LinkList;
