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
registerBlockType("journalist/audio", {
  title: "Audio J",
  description: __(
    "How to use the RichText component for building your own editable blocks.",
    "jsforwpblocks"
  ),
  category: "common",
  icon: "smiley",
  keywords: [
    __("Banner", "jsforwpblocks"),
    __("Call to Action", "jsforwpblocks"),
    __("Message", "jsforwpblocks")
  ],
  attributes: {},
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
      <div className="jaudio">
        <InnerBlocks allowedBlocks={["core/audio", "jourblocks/profile"]} />
      </div>
    );
  },
  save: props => {
    const {
      attributes: { message }
    } = props;
    return (
      <div className="jaudio">
        <InnerBlocks.Content />
      </div>
    );
  }
});
