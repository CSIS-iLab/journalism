const { __, setLocaleData } = wp.i18n;
const { registerBlockType } = wp.blocks;
const { RichText, InspectorControls, ColorPalette, MediaUpload } = wp.editor;
var component;
const {
  TextControl,
  SelectControl,
  Notice,
  Placeholder,
  ToggleControl,
  PanelBody,
  FontSizePicker
} = wp.components;
const { createHigherOrderComponent, withState, setState } = wp.compose;
const { Fragment } = wp.element;

function ampExtraProps(props, blockType, attributes) {
  var ampAtts = {};

  // Shortcode props are handled differently.
  if ("core/shortcode" === blockType.name) {
    return props;
  }
  // AMP blocks handle layout and other props on their own.
  if ("amp/" === blockType.name.substr(0, 4)) {
    return props;
  }
  return _.extend(ampAtts, props);
}

function ampAtts(settings, name) {
  var ampFitText, source;
  if ("core/heading" === name) {
    if (!settings.attributes) {
      settings.attributes = {};
    }
    settings.attributes.ampFitText = {
      source: "attribute",
      attribute: "ampFitText",
      default: false
    };
    settings.attributes.source = {
      source: "html",
      selector: ".img-caption"
    };
  }
  return settings;
}

const ampFilterEdit = createHigherOrderComponent(BlockEdit => {
  return props => {
    const { className, setAttributes } = props;
    const { attributes } = props;
    var ampFitText = props.attributes.ampFitText;
    var source = props.attributes.source;

    function onChangeToggle(newToggle) {
      props.setAttributes({ ampFitText: !ampFitText });
    }
    function onChangeSource(newSource) {
      props.setAttributes({ source: newSource });
    }
    if ("core/heading" == props.name) {
      return (
        <Fragment>
          <div className={"amp-" + props.attributes.ampFitText}>
            <BlockEdit {...props} />
            <InspectorControls>
              <PanelBody
                title="My Block Settings"
                className={ampFitText ? "is-amp-fit-text" : ""}
              >
                <ToggleControl
                  label="test"
                  checked={ampFitText}
                  onChange={onChangeToggle}
                />
              </PanelBody>
            </InspectorControls>

            <RichText
              className="img-caption"
              key="editable"
              tagName="p"
              placeholder="Enter your caption"
              //className={className}
              //style={{ textAlign: alignment }}
              onChange={onChangeSource}
              value={attributes.source}
            />
          </div>
        </Fragment>
      );
    } else {
      return (
        <Fragment>
          <BlockEdit {...props} />
        </Fragment>
      );
    }
  };
}, "ampFilterEdit");

function ampSave(element, blockType, atts) {
  const source = atts.source;
  const ampFitText = atts.ampFitText;

  if ("core/heading" !== blockType.name) {
    return element;
  }
  if ("core/heading" === blockType.name) {
    if (atts.ampFitText === false) {
      return (
        <div class="amp-false">
          {element}
          <RichText.Content
            class="img-caption"
            tagName="p"
            value={atts.source}
          />
        </div>
      );
    } else {
      return (
        <div class="amp-true">
          {element}
          <RichText.Content
            class="img-caption"
            tagName="p"
            value={atts.source}
          />
        </div>
      );
    }
  }
  // if ("core/heading" === blockType.name && atts.ampFitText) {
  //   console.log("yes ampFitText");
  //   return (
  //     <div>
  //       {element}
  //       <RichText.Content class="img-caption" tagName="p" value={source} />
  //       {source}
  //     </div>
  //   );
  // }
}

wp.hooks.addFilter("blocks.registerBlockType", "amp/atts", ampAtts);

wp.hooks.addFilter("editor.BlockEdit", "amp/edit", ampFilterEdit);
//wp.hooks.addFilter("editor.BlockListBlock", "amp/editlist", ampListEdit);
wp.hooks.addFilter("blocks.getSaveElement", "amp/save", ampSave);

wp.hooks.addFilter(
  "blocks.getSaveContent.extraProps",
  "amp/addExtraAttributes",
  ampExtraProps
);
