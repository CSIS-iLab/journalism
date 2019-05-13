const { __ } = wp.i18n;
const el = wp.element.createElement;
const { registerBlockType } = wp.blocks;
const {
  RichText,
  BlockControls,
  BlockFormatControls,
  AlignmentToolbar,
  InnerBlocks
} = wp.editor;
registerBlockType("jourblocks/profile", {
  title: __("Example - RichText", "jsforwpblocks"),
  description: __(
    "How to use the RichText component for building your own editable blocks.",
    "jourblocks"
  ),
  category: "common",
  icon: "smiley",
  keywords: [__("Profile", "jourblocks")],
  attributes: {
    message: {
      type: "array",
      source: "children",
      selector: ".message-body"
    }
  },
  edit: props => {
    const {
      attributes: { message },
      className,
      setAttributes
    } = props;
    const onChangeMessage = message => {
      setAttributes({ message });
    };
    return (
      <div className={className}>
        <h2>{__("Profile", "jourblocks")}</h2>
        <RichText
          tagName="div"
          multiline="p"
          placeholder={__("Add your custom message", "jourblocks")}
          onChange={onChangeMessage}
          value={message}
        />
        <InnerBlocks allowedBlocks={["core/paragraph"]} />
      </div>
    );
  },
  save: props => {
    const {
      attributes: { message }
    } = props;
    return (
      <div>
        <h2>{__("Call to Action", "jourblocks")}</h2>
        <div class="message-body">{message}</div>
        <InnerBlocks.Content />
      </div>
    );
  }
});
