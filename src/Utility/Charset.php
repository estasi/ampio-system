<?php

/**
 * Date: 06.12.2019
 * Time: 23:25
 */
declare(strict_types=1);

namespace Ampio\System\Utility;

/**
 * Class Charset
 *
 * @package Ampio\System\Utility
 */
abstract class Charset
{
    public const IBM_866          = 'IBM866';
    public const _866             = '866';
    public const CP1_251          = 'CP1251';
    public const WINDOWS_1251     = 'WINDOWS-1251';
    public const WINDOWS_1252     = 'WINDOWS-1252';
    public const _936             = '936';
    public const _950             = '950';
    public const GB_2312          = 'GB2312';
    public const SJIS             = 'SJIS';
    public const SJIS_WIN         = 'SJIS-WIN';
    public const EUCJP            = 'EUCJP';
    public const EUCJP_WIN        = 'EUCJP-WIN';
    public const ASCII            = 'ASCII';
    public const ISO_8859_1       = 'ISO-8859-1';
    public const ISO_8859_2       = 'ISO-8859-2';
    public const ISO_8859_3       = 'ISO-8859-3';
    public const ISO_8859_4       = 'ISO-8859-4';
    public const ISO_8859_5       = 'ISO-8859-5';
    public const ISO_8859_7       = 'ISO-8859-7';
    public const ISO_8859_9       = 'ISO-8859-9';
    public const ISO_8859_10      = 'ISO-8859-10';
    public const ISO_8859_13      = 'ISO-8859-13';
    public const ISO_8859_14      = 'ISO-8859-14';
    public const ISO_8859_15      = 'ISO-8859-15';
    public const ISO_8859_16      = 'ISO-8859-16';
    public const KOI_8_R          = 'KOI8-R';
    public const KOI_8_U          = 'KOI8-U';
    public const KOI_8_RU         = 'KOI8-RU';
    public const CP_1250          = 'CP1250';
    public const CP_1251          = 'CP1251';
    public const CP_1252          = 'CP1252';
    public const CP_1253          = 'CP1253';
    public const CP_1254          = 'CP1254';
    public const CP_1257          = 'CP1257';
    public const CP_850           = 'CP850';
    public const CP_866           = 'CP866';
    public const CP_1131          = 'CP1131';
    public const MACROMAN         = 'MACROMAN';
    public const MACCENTRALEUROPE = 'MACCENTRALEUROPE';
    public const MACICELAND       = 'MACICELAND';
    public const MACCROATIAN      = 'MACCROATIAN';
    public const MACROMANIA       = 'MACROMANIA';
    public const MACCYRILLIC      = 'MACCYRILLIC';
    public const MACUKRAINE       = 'MACUKRAINE';
    public const MACGREEK         = 'MACGREEK';
    public const MACTURKISH       = 'MACTURKISH';
    public const MACINTOSH        = 'MACINTOSH';
    public const ISO_8859_6       = 'ISO-8859-6';
    public const ISO_8859_8       = 'ISO-8859-8';
    public const CP_1255          = 'CP1255';
    public const CP_1256          = 'CP1256';
    public const CP_862           = 'CP862';
    public const MACHEBREW        = 'MACHEBREW';
    public const MACARABIC        = 'MACARABIC';
    public const EUC_JP           = 'EUC-JP';
    public const SHIFT_JIS        = 'SHIFT_JIS';
    public const CP_932           = 'CP932';
    public const ISO_2022_JP      = 'ISO-2022-JP';
    public const ISO_2022_JP_2    = 'ISO-2022-JP-2';
    public const ISO_2022_JP_1    = 'ISO-2022-JP-1';
    public const EUC_CN           = 'EUC-CN';
    public const HZ               = 'HZ';
    public const GBK              = 'GBK';
    public const CP_936           = 'CP936';
    public const GB_18030         = 'GB18030';
    public const EUC_TW           = 'EUC-TW';
    public const BIG_5            = 'BIG5';
    public const CP_950           = 'CP950';
    public const BIG_5_HKSCS      = 'BIG5-HKSCS';
    public const BIG_5_HKSCS_2004 = 'BIG5-HKSCS:2004';
    public const BIG_5_HKSCS_2001 = 'BIG5-HKSCS:2001';
    public const BIG_5_HKSCS_1999 = 'BIG5-HKSCS:1999';
    public const ISO_2022_CN      = 'ISO-2022-CN';
    public const ISO_2022_CN_EXT  = 'ISO-2022-CN-EXT';
    public const EUC_KR           = 'EUC-KR';
    public const CP_949           = 'CP949';
    public const ISO_2022_KR      = 'ISO-2022-KR';
    public const JOHAB            = 'JOHAB';
    public const ARMSCII_8        = 'ARMSCII-8';
    public const GEORGIAN_ACADEMY = 'GEORGIAN-ACADEMY';
    public const GEORGIAN_PS      = 'GEORGIAN-PS';
    public const KOI_8_T          = 'KOI8-T';
    public const PT_154           = 'PT154';
    public const RK_1048          = 'RK1048';
    public const ISO_8859_11      = 'ISO-8859-11';
    public const TIS_620          = 'TIS-620';
    public const CP_874           = 'CP874';
    public const MACTHAI          = 'MACTHAI';
    public const MULELAO_1        = 'MULELAO-1';
    public const CP_1133          = 'CP1133';
    public const VISCII           = 'VISCII';
    public const TCVN             = 'TCVN';
    public const CP_1258          = 'CP1258';
    public const HP_ROMAN_8       = 'HP-ROMAN8';
    public const NEXTSTEP         = 'NEXTSTEP';
    public const UTF_8            = 'UTF-8';
    public const UCS_2            = 'UCS-2';
    public const UCS_2_BE         = 'UCS-2BE';
    public const UCS_2_LE         = 'UCS-2LE';
    public const UCS_4            = 'UCS-4';
    public const UCS_4_BE         = 'UCS-4BE';
    public const UCS_4_LE         = 'UCS-4LE';
    public const UTF_16           = 'UTF-16';
    public const UTF_16_BE        = 'UTF-16BE';
    public const UTF_16_LE        = 'UTF-16LE';
    public const UTF_32           = 'UTF-32';
    public const UTF_32_BE        = 'UTF-32BE';
    public const UTF_32_LE        = 'UTF-32LE';
    public const UTF_7            = 'UTF-7';
    public const C_99             = 'C99';
    public const JAVA             = 'JAVA';
    public const CP_437           = 'CP437';
    public const CP_737           = 'CP737';
    public const CP_775           = 'CP775';
    public const CP_852           = 'CP852';
    public const CP_853           = 'CP853';
    public const CP_855           = 'CP855';
    public const CP_857           = 'CP857';
    public const CP_858           = 'CP858';
    public const CP_860           = 'CP860';
    public const CP_861           = 'CP861';
    public const CP_863           = 'CP863';
    public const CP_865           = 'CP865';
    public const CP_869           = 'CP869';
    public const CP_1125          = 'CP1125';
    public const CP_864           = 'CP864';
    public const EUC_JISX_0213    = 'EUC-JISX0213';
    public const SHIFT_JISX_0213  = 'Shift_JISX0213';
    public const ISO_2022_JP_3    = 'ISO-2022-JP-3';
    public const BIG_5_2003       = 'BIG5-2003';
    public const TDS_565          = 'TDS565';
    public const ATARIST          = 'ATARIST';
    public const RISCOS_LATIN_1   = 'RISCOS-LATIN1';
}
