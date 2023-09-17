// SPDX-License-Identifier: MIT
pragma solidity ^0.8.9;

import "@openzeppelin/contracts/token/ERC721/ERC721.sol";
import "@openzeppelin/contracts/access/Ownable.sol";
import "@openzeppelin/contracts/utils/Counters.sol";
import "@openzeppelin/contracts/utils/Strings.sol";
import "@openzeppelin/contracts/utils/Base64.sol";

//Mine Labor Simulator Item Contract
contract ForcedHODL is ERC721, Ownable {
    using Counters for Counters.Counter;
    using Strings for uint256;

    Counters.Counter private _tokenIdCounter;

    constructor() ERC721("Forced HODL", "FHDL") {}

    function safeMint(address to) public {
        uint256 tokenId = _tokenIdCounter.current();
        _tokenIdCounter.increment();
        _safeMint(to, tokenId);
        tokenURI(tokenId);
    }

    //Values
    string public maturity;
    string public description;
    string public imgURL;


    function setDescription(string memory _description, string memory _maturity) public {
        imgURL = "https://forcedhodl.com/logo.png";
        description = _description;
        maturity = _maturity;
    }
    
    function tokenURI(uint256 tokenId)
        public
        view
        override
        returns (string memory)
    {
        bytes memory dataURI = abi.encodePacked(
            '{',
                '"name": "Forced HODL Wallet #', tokenId.toString(), '"'',',
                '"description": ''"', description, '"',',',
                '"external_url": "https://forcedhodl.com/"'',',
                '"image": ''"', imgURL, '"',',',
                '"attributes":',
                    '[',
                        '{',
                            '"trait_type": "Maturity Date"'',', 
                            '"value": ''"', maturity, '"',
                        '}',

                    ']',
            '}'
        );
        return string(
            abi.encodePacked(
                "data:application/json;base64,",
                Base64.encode(dataURI)
            )
        );
    }
}