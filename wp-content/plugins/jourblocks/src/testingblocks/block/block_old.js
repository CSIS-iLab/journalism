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
const { createHigherOrderComponent } = wp.compose;
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
  var ampFitText;
  if ("core/heading" === name) {
    if (!settings.attributes) {
      settings.attributes = {};
    }
    settings.attributes.ampFitText = {
      default: false
    };
    settings.attributes.minFont = {
      default: 14,
      source: "attribute",
      selector: "amp-fit-text",
      attribute: "min-font-size"
    };
    settings.attributes.maxFont = {
      default: 49,
      source: "attribute",
      selector: "amp-fit-text",
      attribute: "max-font-size"
    };
    settings.attributes.height = {
      default: 50,
      source: "attribute",
      selector: "amp-fit-text",
      attribute: "height"
    };
  }
  return settings;
}

function ampFilterEdit(BlockEdit) {
  var el = wp.element.createElement;

  return function(props) {
    var attributes = props.attributes,
      name = props.name,
      ampLayout,
      inspectorControls;

    if ("" === inspectorControls) {
      // Return original.
      return [
        el(
          BlockEdit,
          _.extend(
            {
              key: "original"
            },
            props
          )
        )
      ];
    } else if ("core/heading" === name) {
      inspectorControls = setUpInspectorControls(props);
    }
    return [
      el(
        BlockEdit,
        _.extend(
          {
            key: "original"
          },
          props
        )
      ),
      inspectorControls
    ];
  };
}

function setUpInspectorControls(props) {
  const el = wp.element.createElement;
  var attributes = props.attributes;
  var name = props.name;
  var ampFitText = props.attributes.ampFitText;
  var minFont = props.attributes.minFont;
  var maxFont = props.attributes.maxFont;
  var height = props.attributes.height;
  var isSelected = props.isSelected;
  if ("core/heading" !== props.name) {
    //Reurn without change
    return BlockEdit;
  }

  if (!isSelected) {
    return null;
  }

  inspectorArgs = [
    PanelBody,
    {
      title: "Amp Fit Text",
      className: ampFitText ? "is-amp-fit-text" : ""
    },
    el(ToggleControl, {
      label: "test",
      checked: ampFitText,
      onChange: function() {
        props.setAttributes({ ampFitText: !ampFitText });
      }
    })
  ];

  FONT_SIZES = [
    {
      name: "small",
      shortName: __("S"),
      size: 14
    },
    {
      name: "regular",
      shortName: __("M"),
      size: 16
    },
    {
      name: "large",
      shortName: __("L"),
      size: 36
    },
    {
      name: "larger",
      shortName: __("XL"),
      size: 48
    }
  ];

  if (ampFitText) {
    inspectorArgs.push.apply(inspectorArgs, [
      el(TextControl, {
        label: __("Height"),
        value: height,
        min: 1,
        onChange: function(nextHeight) {
          props.setAttributes({ height: nextHeight });
        }
      }),
      parseInt(maxFont) > parseInt(height) &&
        el(
          wp.components.Notice,
          {
            status: "error",
            isDismissible: false
          },
          __("The height must be greater than the max font size.")
        ),
      el(
        PanelBody,
        { title: __("Minimum font size") },
        el(FontSizePicker, {
          fallbackFontSize: 14,
          value: minFont,
          fontSizes: FONT_SIZES,
          onChange: function(nextMinFont) {
            if (!nextMinFont) {
              nextMinFont = 14; // @todo Supplying fallbackFontSize should be done automatically by the component?
            }
            if (parseInt(nextMinFont) <= parseInt(maxFont)) {
              props.setAttributes({ minFont: nextMinFont });
            }
          }
        })
      ),
      parseInt(minFont) > parseInt(maxFont) &&
        el(
          wp.components.Notice,
          {
            status: "error",
            isDismissible: false
          },
          __("The min font size must less than the max font size.")
        ),
      el(
        PanelBody,
        { title: __("Maximum font size") },
        el(FontSizePicker, {
          value: maxFont,
          fallbackFontSize: 48,
          fontSizes: FONT_SIZES,
          onChange: function(nextMaxFont) {
            if (!nextMaxFont) {
              nextMaxFont = 48; // @todo Supplying fallbackFontSize should be done automatically by the component?
            }
            props.setAttributes({
              maxFont: nextMaxFont,
              height: Math.max(nextMaxFont, height)
            });
          }
        })
      )
    ]);
  }

  return el(
    InspectorControls,
    {
      key: "inspector"
    },
    el.apply(null, inspectorArgs)
  );
}

function ampListEdit(BlockListBlock) {
  return function(props) {
    //var el = wp.element.createElement;
    console.log("it's working");
  };
}

function ampSave(element, blockType, atts) {
  if ("core/heading" !== blockType.name || !atts.ampFitText) {
    return element;
  }
  //Custom logic
  const fitTextProps = {
    layout: "fixed-height",
    children: element
  };

  //fitTextProps["min-font-size"] = "atts.minFont";
  if ("core/heading" && atts.ampFitText) {
    //fitTextProps["min-font-size"] = atts.minFont;
    //fitTextProps["data-font"] = "50";

    if (atts.minFont) {
      fitTextProps["min-font-size"] = atts.minFont;
    }
    if (atts.maxFont) {
      fitTextProps["max-font-size"] = atts.maxFont;
    }
    if (atts.height) {
      fitTextProps.height = atts.height;
    }
    return wp.element.createElement("amp-fit-text", fitTextProps);
  }
  //Add other setAttributes
  return element;
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

function withInspectorControls(BlockEdit) {
  if ("core/heading" == props.name) {
    createHigherOrderComponent(BlockEdit => {
      return props => {
        return (
          <Fragment>
            <BlockEdit {...props} />
            <InspectorControls>
              <PanelBody>My custom control</PanelBody>
            </InspectorControls>
            <p>{props.name}</p>
          </Fragment>
        );
      };
    }, "withInspectorControl");
  }
}

//wp.hooks.addFilter(
//"editor.BlockEdit",
//"my-plugin/with-inspector-controls",
//withInspectorControls
//);
